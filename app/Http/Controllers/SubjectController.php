<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subject\StoreSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        if ($user->can('authorize', Subject::class)) {
            return view('subjects/create');
        } else {
            $message = "you don't have permission";
            return redirect()->back()->with('message', $message);
        }
    }


    public function store(StoreSubject $request)
    {
        $subject = new Subject();
        $validated = $request->validated();
        $subject->create($validated);
        return redirect('subjects');
    }

    public function destroy(Subject $subject)
    {
        $user = Auth::user();
        if ($user->can('authorize', Subject::class)) {
            $subject->delete();
            return redirect()->route('subjects.index');
        } else {
            $message = "you don't have permission";
            return redirect()->back()->with('message', $message);
        }
    }
}
