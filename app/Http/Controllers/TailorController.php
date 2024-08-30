<?php

namespace App\Http\Controllers;

use App\Events\HireAcceptedEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tailor;

class TailorController extends Controller
{
    public function tailorDashboard()
    {
        return view('tailor.dashboard');
    }

    public function show($id)
    {
        $tailor = Tailor::with('user')->find($id);
        return view('tailor.show', compact('tailor'));
    }
}
