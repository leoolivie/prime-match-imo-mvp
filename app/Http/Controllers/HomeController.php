<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function investor()
    {
        return view('landing.investor');
    }

    public function businessman()
    {
        return view('landing.businessman');
    }

    public function master()
    {
        return view('landing.master');
    }
}
