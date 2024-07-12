<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tailor;

class TailorController extends Controller
{
    public function tailorDashboard()
    {
        return view('tailor.dashboard');
    }

    public function show($id)
    {
        $tailor = Tailor::with('user')->findOrFail($id);
        return view('tailor.show', compact('tailor'));
    }
}
