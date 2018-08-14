<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\type;
use Psy\Util\Str;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        $marks = Mark::all();
        $subjects = Subject::all();

        foreach ($groups as $group) {
            foreach ($subjects as $subject) {
                $SubAvg[$group->id][$subject->id] = DB::table('marks')
                    ->selectRaw('AVG(mark) as mark')
                    ->where([['subject_id', '=', $subject->id], ['group_id', '=', $group->id]])
                    ->get();
            }
            $GenAvg[$group->id] = DB::table('marks')
                ->selectRaw('AVG(mark) as mark')
                ->where('group_id', '=', $group->id)
                ->get();
        }

        return view('groups/groups', [
            'groups' => $groups,
            'subjects' => $subjects,
            'marks' => $marks,
            'SubAvg' => $SubAvg,
            'GenAvg' => $GenAvg
        ]);
    }

    public function create()
    {
        return view('groups/create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30|unique:groups',
            'description' => 'required|max:255',
        ]);
        $group = new Group();
        $group->create($request->all());
        return redirect('groups');
    }


    public function show(Group $group)
    {
        $group->load('students.marks');
        $subjects = Subject::all();
        return view('groups/show', [
            'group' => $group,
            'subjects' => $subjects
        ]);
    }


    public function edit(Group $group)
    {
        return view('groups/edit', [
            'group' => $group
        ]);
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
        $group->delete();
        return redirect('groups');
    }
}
