<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('roles')->find(2);
        return $user; // roles = fn
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::find(2);
        $user->roles()->sync([1, 2, 3]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
    public function customerDashboard()
    {
        // return view('customer.dashboard');
        return view('index');
    }
    public function customerProfile(int $id)
    {
        Gate::authorize('view-profile', $id);
        $user = User::findOrFail($id);
        return $user;
    }
    public function tailorDashboard()
    {
        return view('tailor.dashboard');
    }
    public function defaultDashboard()
    {
        return view('default');
    }
}
