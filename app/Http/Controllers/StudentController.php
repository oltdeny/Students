<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        if ($user->can('authorize', Student::class)) {
            return view('groups/students/create', ['group' => $group]);
        } else {
            $message = "you don't have permission";
            return redirect()->back()->with('message', $message);
        }
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
        $user = Auth::user();
        if ($user->can('authorize', Student::class)) {
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
        } else {
            $message = "you don't have permission";
            return redirect()->back()->with('message', $message);
        }
    }

    public function edit(Group $group, Student $student)
    {
        $user = Auth::user();
        if ($user->can('authorize', Student::class)) {
            $groups = Group::where('id', '!=', $group->id)->get();
            return view('groups/students/edit', [
                'currentGroup' => $group,
                'groups' => $groups,
                'student' => $student
            ]);
        } else {
            $message = "you don't have permission";
            return redirect()->back()->with('message', $message);
        }
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
        $user = Auth::user();
        if ($user->can('authorize', Student::class)) {
            $student->delete();
            return redirect()->route('groups.show', $group);
        } else {
            $message = "you don't have permission";
            return redirect()->back()->with('message', $message);
        }
    }

    public function addPhoto(Request $request, Group $group, Student $student)
    {
        $user = Auth::user();
        if ($user->can('authorize', Student::class)) {
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = $student->id.'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save(public_path('/avatars/'.$filename));
                $student->avatar = $filename;
                $student->save();
            }
            return redirect()->route('groups.students.show', [$group, $student]);
        } else {
            $message = "you don't have permission";
            return redirect()->back()->with('message', $message);
        }
    }
}
