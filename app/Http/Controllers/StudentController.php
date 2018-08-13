<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        $groups = Group::all();
        $studentsOfGroup = [];
        foreach ($groups as $group) {
            $studentsOfGroup[] = Student::where('group_id', $group->id)->get();
        }
        return view('students', [
            'groups' => $groups,
            'studentsOfGroup' => $studentsOfGroup
        ]);
    }

    public function create(Group $group)
    {
        return view('groups/students/create', ['group' => $group]);
    }


    public function store(Request $request, Group $group)
    {
        $this->validate($request, [
            'name' => 'required|max:30|',
            'surname' => 'required|max:30',
            'patronymic' => 'required|max:30'
        ]);
        $student = new Student();
        $student->create([
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'group_id' => $group->id,

        ]);
        return redirect('groups/' . $group->id);
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

    public function update(Request $request, Group $group, Student $student)
    {
        $this->validate($request, [
            'name' => 'required|max:30',
            'surname' => 'required|max:30',
            'patronymic' => 'required|max:30',
        ]);

        $student->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
        ]);
        return redirect('groups/'.$group->id.'/students/'.$student->id);
    }

    public function destroy(Group $group, Student $student)
    {
        $student->delete();
        return redirect('groups/'.$group->id);
    }
}
