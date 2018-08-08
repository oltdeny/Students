<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __invoke()
    {
        $students = \App\Student::all();
        return view('students', [
            'students' => $students
        ]);
    }
}
