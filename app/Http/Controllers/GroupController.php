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
        $subjects = Subject::all();
        $avgs = Group::avg($subjects)->paginate(1);
        return view('groups/groups', [
            'subjects' => $subjects,
            'avgs' => $avgs,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Group::class);
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
        $this->authorize('update', $group);
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
        $this->authorize('delete', $group);
        $group->delete();
        return redirect('groups');
    }
}
