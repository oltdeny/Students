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
        $user = Auth::user();
        if ($user->can('authorize', Mark::class)) {
            $subjects = Subject::all();
            return view('groups/students/marks/create', [
                'student' => $student,
                'subjects' => $subjects,
                'group' => $group
            ]);
        } else {
            $message = "you don't have permission";
            return redirect()->back()->with('message', $message);
        }
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
        $user = Auth::user();
        if ($user->can('authorize', Mark::class)) {
            return view('groups/students/marks/edit', [
                'group' => $group,
                'student' => $student,
                'mark' => $mark
            ]);
        } else {
            $message = "you don't have permission";
            return redirect()->back()->with('message', $message);
        }
    }

    public function update(UpdateMark $request, Group $group, Student $student, Mark $mark)
    {
        $validated = $request->validated();
        $mark->update($validated);
        return redirect()->route('groups.students.show', [$group, $student]);
    }
}
