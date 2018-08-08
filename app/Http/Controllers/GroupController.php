<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function index()
    {
        $groups = Group::all();
        return view('groups', [
            'groups' => $groups
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Group $group)
    {
        $students = Student::where('group_id', $group->id)->get();
        return view('students', [
            'groupName'=>$group->name,
            'students' => $students
        ]);
    }


    public function edit(Group $group)
    {
        //
    }


    public function update(Request $request, Group $group)
    {
        //
    }


    public function destroy(Group $group)
    {

    }
}
