<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Style\StyleInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $groups = Group::all();
        $subjects = Subject::all();
        session_start();
        foreach ($request->request as $key => $parameter) {
            if (isset($parameter)) {
                $_SESSION[$key] = $parameter;
            }
        }
        if (isset($request->reset)) {
            $_SESSION = [];
        }
        $filter = (object)$_SESSION;
        if (!empty($filter)) {
            $students = Student::filter($filter)->simplePaginate(3);
        } else {
            $students = (new Student)->paginate(3);
        }
        $students->load('group', 'marks');
        return view('home', [
            'filter' => $filter,
            'groups' => $groups,
            'students' => $students,
            'subjects' => $subjects
        ]);
    }
}
