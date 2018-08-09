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
        return view('groups', [
            'groups' => $groups
        ]);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        //
    }


    public function show(Group $group)
    {
        $group->load('students.marks.subject');
        return view('students/show_students', [
            'group' => $group,
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
