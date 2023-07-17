<?php

namespace App\Http\Controllers\Admin;

class HomeController
{
    public function index()
    {
        return view('home');
    }


    // Xử lí My Team
    public function myteam()
    {
        return view('myteam');
    }
    
    public function inbox()
    {
        return view('inbox');
    }

}
