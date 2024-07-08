<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TailorController extends Controller
{
    public function tailorDashboard()
    {
        return view('tailor.dashboard');
    }
}
