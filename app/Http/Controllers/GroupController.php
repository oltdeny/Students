<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Group;

class GroupController extends Controller
{
    public function __invoke()
    {
        $groups = Group::all();
        return view('groups', [
            'groups' => $groups
        ]);
    }
}
