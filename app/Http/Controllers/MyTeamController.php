<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyTeamController extends Controller
{
       /**
     * Hiển thị trang My Team.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.myteam');
    }
}
