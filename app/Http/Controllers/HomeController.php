<?php

namespace Onboardr\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Onboardr\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
