<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mark\StoreMark;
use App\Http\Requests\Mark\UpdateMark;
use App\Models\Group;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarkController extends Controller
{
    public function create(Group $group, Student $student)
    {
        $this->authorize('create', Mark::class);
        $subjects = Subject::all();
        return view('groups/students/marks/create', [
            'student' => $student,
            'subjects' => $subjects,
            'group' => $group
        ]);
    }

    public function store(StoreMark $request, Group $group, Student $student)
    {
        $mark = new Mark();
        $validated = $request->validated();
        $mark->create($validated + [
            'group_id' => $group->id,
            'student_id' => $student->id,
        ]);
        return redirect()->route('groups.students.show', [$group, $student]);
    }

    public function edit(Group $group, Student $student, Mark $mark)
    {
        $this->authorize('update', Mark::class);
        return view('groups/students/marks/edit', [
            'group' => $group,
            'student' => $student,
            'mark' => $mark
        ]);
    }

    public function update(UpdateMark $request, Group $group, Student $student, Mark $mark)
    {
        $validated = $request->validated();
        $mark->update($validated);
        return redirect()->route('groups.students.show', [$group, $student]);
    }
}
