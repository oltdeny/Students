<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\StoreGroup;
use App\Models\Group;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Query;
use function PHPSTORM_META\type;
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

        $students = Student::all();
        $students->load('group', 'marks');
        foreach ($students as $student) {
            $student->avg_mark = $student->marks->avg('mark');
        }
        $achievers = $students->where('avg_mark', '=', 5);
        $goods = $students->where('avg_mark', '>', 4.5)->where('avg_mark', '<', 5);

        return view('groups/groups', [
            'groups' => $groups,
            'subjects' => $subjects,
            'marks' => $marks,
            'avgs' => $avgs,
            'achievers' => $achievers,
            'goods' => $goods
        ]);
    }

    public function create()
    {
        return view('groups/create');
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
