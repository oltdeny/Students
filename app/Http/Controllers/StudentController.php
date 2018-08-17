<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StoreStudent;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function create(Group $group)
    {
        return view('groups/students/create', ['group' => $group]);
    }


    public function store(StoreStudent $request, Group $group)
    {
        $validated = $request->validated();
        $student = new Student();
        $student->create($validated + ['group_id' => $group->id]);
        return redirect()->route('groups.show', $group);
    }

    public function show(Group $group, Student $student)
    {
        $student->load([
            'marks' => function ($query) {
                $query->orderBy('subject_id', 'asc');
            },
            'group',
            'marks.subject'
        ]);
        $subjects = Subject::all();
        return view('groups/students/show', [
            'student' => $student,
            'subjects' => $subjects,
            'group' => $group
        ]);
    }

    public function edit(Group $group, Student $student)
    {
        return view('groups/students/edit', [
            'group' => $group,
            'student' => $student
        ]);
    }

    public function update(StoreStudent $request, Group $group, Student $student)
    {
        $validated = $request->validated();
        $student->update($validated);
        return redirect()->route('groups.students.show', [$group, $student]);
    }

    public function destroy(Group $group, Student $student)
    {
        $student->delete();
        return redirect()->route('groups.show', $group);
    }
}
