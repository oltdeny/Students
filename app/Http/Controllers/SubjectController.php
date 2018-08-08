<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __invoke()
    {
        $subjects = \App\Subject::all();
        return view('subjects', [
            'subjects' => $subjects
        ]);
    }
}
