<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use stdClass;
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
            $_SESSION[$key] = $parameter;
        }
        if (isset($request->reset)) {
            $_SESSION = [];
        }
        $filter = (object)$_SESSION;
        $page = request()->get('page');
        $students = Student::filter($filter)->get();
        $students->load('group', 'marks');
        $total = $students->count();
        if (isset($filter->per_page)) {
            $perPage = $filter->per_page > 0 ? $filter->per_page : 5;
        } else {
            $perPage = $request->per_page > 0 ? $request->per_page : 5;
        }
        $paginatedCollection = new LengthAwarePaginator($students, $total, $perPage, $page);
        if ($page < 1) {
            $students = $paginatedCollection->slice(0, $perPage);
        } else {
            $students = $paginatedCollection->slice(($page-1)*$perPage, $perPage);
        }
        return view('home', [
            'filter' => $filter,
            'groups' => $groups,
            'students' => $students,
            'paginatedCollection' => $paginatedCollection,
            'subjects' => $subjects
        ]);
    }
}
