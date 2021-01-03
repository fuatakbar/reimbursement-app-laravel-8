<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   

        if (Auth::user()->role == 1) {
            # code...
        } elseif (Auth::user()->role == 2) {
            // 
        } elseif (Auth::user()->role == 3) {
            // 
        } elseif (Auth::user()->role == 4) {
            // 
        }

        return view('pages.index');
        
    }
}
