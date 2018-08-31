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
        $page = request()->get('page');
        $students = Student::filter($request)->get();
        $students->load('group', 'marks');
        $total = $students->count();
        $perPage = $request->per_page > 0 ? $request->per_page : 5;
        $paginatedCollection = new LengthAwarePaginator($students, $total, $perPage, $page);
        $paginatedCollection
            ->appends(['name' => isset($request->name)?$request->name: null])
            ->appends(['surname' => isset($request->surname)?$request->surname: null])
            ->appends(['patronymic' => isset($request->patronymic)?$request->patronymic: null])
            ->appends(['per_page' => isset($request->per_page)?$request->per_page: null])
            ->appends(['group_id' => isset($request->group_id)?$request->group_id: null])
            ->appends(['sort' => isset($request->sort)?$request->sort: null]);
        foreach ($subjects as $subject) {
            $paginatedCollection->appends([
                'avg'.$subject->id => isset($request->{'avg'.$subject->id})?$request->{'avg'.$subject->id}: null
            ]);
        }
        $sorted = $paginatedCollection;
        if (isset($request->sort)) {
            $sorted = $paginatedCollection->sortBy($request->sort);
        }
        if ($page < 1) {
            $students = $sorted->slice(0, $perPage);
        } else {
            $students = $sorted->slice(($page-1)*$perPage, $perPage);
        }
        return view('home', [
            'request' => $request,
            'groups' => $groups,
            'students' => $students,
            'paginatedCollection' => $paginatedCollection,
            'subjects' => $subjects,
        ]);
    }
}
