<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function index()
    {
        $groups = Group::all();
        return view('groups/groups', [
            'groups' => $groups
        ]);
    }



    public function create()
    {
        return view('groups/create_group');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30|unique:groups',
            'description' => 'required|max:255',
        ]);
        $group = new Group();
        $group->create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return redirect('groups');
    }


    public function show(Group $group)
    {
        $group->load('students.marks.subject');
        $subjects = Subject::all();
        return view('groups/show_group', [
            'group' => $group,
            'subjects' => $subjects
        ]);
    }


    public function edit(Group $group)
    {
        return view('groups/edit_group', [
            'group' => $group
        ]);
    }


    public function update(Request $request, Group $group)
    {
        $this->validate($request, [
            'name' => 'required|max:30|unique:groups,name,' . $group->id,
            'description' => 'required|max:255',
        ]);

        $group->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return redirect('groups');
    }


    public function destroy(Group $group)
    {
        $group->delete();
        return redirect('groups');
    }
}
