<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\StoreGroup;
use App\Models\Group;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Query;
use Psy\Util\Str;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::paginate(1);
        $marks = (new Mark)->getTable();
        $subjects = Subject::all();
        $query = Group::select('groups.*');
        foreach ($subjects as $subject) {
            $subQuery = Mark::selectRaw("AVG({$marks}.mark) as mark")
                ->whereRaw("{$marks}.group_id = groups.id")
                ->where("{$marks}.subject_id", $subject->id);
            $query->selectSub($subQuery, $subject->id);
        }
        $subQueryAvg = Mark::selectRaw("AVG({$marks}.mark) as mark")
            ->whereRaw("{$marks}.group_id = groups.id");
        $query->selectSub($subQueryAvg, "avg");
        $avgs = $query->paginate(1);

        return view('groups/groups', [
            'groups' => $groups,
            'subjects' => $subjects,
            'marks' => $marks,
            'avgs' => $avgs,
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->can('authorize', Group::class)) {
            return view('groups/create');
        } else {
            $message = "you don't have permission";
            return redirect()->back()->with('message', $message);
        }
    }


    public function store(StoreGroup $request)
    {
        $validated = $request->validated();
        $group = new Group();
        $group->create($validated);
        return redirect('groups');
    }


    public function show(Group $group)
    {
        $students = Student::where('group_id', $group->id)->paginate(3);
        $students->load('marks');
        $subjects = Subject::all();
        return view('groups/show', [
            'group' => $group,
            'students' => $students,
            'subjects' => $subjects
        ]);
    }


    public function edit(Group $group)
    {
        $user = Auth::user();
        if ($user->can('authorize', Group::class)) {
            return view('groups/edit', [
                'group' => $group
            ]);
        } else {
            $message = "you don't have permission";
            return redirect()->back()->with('message', $message);
        }
    }


    public function update(Request $request, Group $group)
    {
        $this->validate($request, [
            'name' => 'required|max:30|unique:groups,name,' . $group->id,
            'description' => 'required|max:255',
        ]);
        $group->update($request->all());
        return redirect()->route('groups.show', $group);
    }

    public function destroy(Group $group)
    {
        $user = Auth::user();
        if ($user->can('authorize', Group::class)) {
            $group->delete();
            return redirect('groups');
        } else {
            $message = "you don't have permission";
            return redirect()->back()->with('message', $message);
        }
    }
}
