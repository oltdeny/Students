<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Symfony\Component\Console\Style\StyleInterface;

class HomeController extends Controller
{
    public function index()
    {
        $students = Student::paginate(4);
        $groups = Group::all();
        $students->load('group', 'marks');
        $subjects = Subject::all();
        return view('welcome', [
            'groups' => $groups,
            'students' => $students,
            'subjects' => $subjects
        ]);
    }

    public function search(Request $request)
    {
        if (isset($request->name)||isset($request->surname)||isset($request->patronymic)||isset($request->group_id)) {
            $students = Student::filter($request)
                ->paginate(3);
        } else {
            $students = Student::paginate(3);
        }
        $students->load('group', 'marks');
        $groups = Group::all();
        $subjects = Subject::all();
        return view('welcome', [
            'groups' => $groups,
            'students' => $students,
            'subjects' => $subjects
        ]);
    }
}
