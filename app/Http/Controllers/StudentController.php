<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Student\StoreStudent;
use App\Http\Requests\Student\SearchStudents;
use App\Http\Requests\Student\UpdateStudent;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File;
use Image;

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
        $groups = Group::where('id', '!=', $group->id)->get();
        return view('groups/students/edit', [
            'currentGroup' => $group,
            'groups' => $groups,
            'student' => $student
        ]);
    }

    public function update(UpdateStudent $request, Group $group, Student $student)
    {
        $validated = $request->validated();
        $student->update($validated);
        $group = Group::find($validated['group_id']);
        return redirect()->route('groups.students.show', [$group, $student]);
    }

    public function destroy(Group $group, Student $student)
    {
        $student->delete();
        return redirect()->route('groups.show', $group);
    }

    public function search(Request $request, Group $group)
    {
        if (isset($request->name) || isset($request->surname) || isset($request->patronymic)) {
            $students = Student::where('group_id', '=', $group->id)
                ->filter($request)
                ->paginate(3);
        } else {
            $students = Student::where('group_id', '=', $group->id)
                ->paginate(3);
        }
        $students->load('marks');
        $subjects = Subject::all();
        return view('groups/show', [
            'group' => $group,
            'subjects' => $subjects,
            'students' => $students
        ]);
    }

    public function addPhoto(Request $request, Group $group, Student $student)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = $student->id.'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/avatars/'.$filename));
            $student->avatar = $filename;
            $student->save();
        }
        return redirect()->route('groups.students.show', [$group, $student]);
    }
}
