<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function __invoke()
    {
        $marks = \App\Mark::all();
        return view('marks', [
            'marks' => $marks
        ]);
    }
}
