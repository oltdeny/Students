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
        return view('students/create_student', ['group' => $group]);
    }


    public function store(Request $request)
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
            'group_id' => $request->group,

        ]);
        return redirect('groups/' . $request->group);
    }

    public function show(Student $student)
    {
        $student->load([
            'marks' => function ($query) {
                $query->orderBy('subject_id', 'asc');
            },
            'group',
            'marks.subject'
        ]);
        $subjects = Subject::all();
        return view('students/students', [
            'student' => $student,
            'subjects' => $subjects
        ]);
    }

    public function edit(Student $student)
    {
        //
    }

    public function update(Request $request, Student $student)
    {
        //
    }

    public function destroy(Student $student)
    {
        try {
            $student->delete();
        } catch (\Exception $e) {
            report($e);
        }
        return back();
    }
}
