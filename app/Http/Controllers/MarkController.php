<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class MarkController extends Controller
{

    public function create(Group $group, Student $student)
    {
        $subjects = Subject::all();
        return view('groups/students/marks/create', [
            'student' => $student,
            'subjects' => $subjects,
            'group' => $group
        ]);
    }

    public function store(Request $request, Group $group, Student $student)
    {
        $this->validate($request, [
            'subject' => 'required',
            'mark' => 'required',
        ]);
        $mark = new Mark();
        $mark->create($request->all());
        $mark->fill(['student_id' => $student->id]);
        return redirect()->route('groups.show');
    }

    public function edit(Group $group, Student $student, Mark $mark)
    {
        return view('groups/students/marks/edit', [
            'group' => $group,
            'student' => $student,
            'mark' => $mark
        ]);
    }

    public function update(Request $request, Group $group, Student $student, Mark $mark)
    {
        $this->validate($request, [
            'mark' => 'required',
        ]);

        $mark->update($request->all());
        return redirect()->route('groups.show');
    }

}
