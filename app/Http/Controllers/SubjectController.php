<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subject\StoreSubject;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function index()
    {
        $subjects = Subject::all();
        return view('subjects/subjects', [
            'subjects' => $subjects
        ]);
    }


    public function create()
    {
        return view('subjects/create');
    }


    public function store(StoreSubject $request)
    {
        $subject = new Subject();
        $validated = $request->validated();
        $subject->create($validated);
        return redirect('subjects');
    }


    public function show(Subject $subject)
    {
        //
    }


    public function edit(Subject $subject)
    {
        //
    }


    public function update(Request $request, Subject $subject)
    {
        //
    }


    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index');
    }
}
