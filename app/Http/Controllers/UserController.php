<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        // Gate::authorize('view_profile', $user->id);
        $user = User::findOrFail($user->id);
        dd($user);
        return view('profile.show', compact('user'));
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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
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
    public function removeCCprefix($phone)
    {
        // Remove the country code prefix
        if (strpos($phone, '+880') === 0) {
            return $phone = substr($phone, 4);
        }
    }
    public function customerProfile()
    {
        if (Gate::denies('view_profile', Auth::user()->id)) {
            abort(401);
        }
        $user = User::findOrFail(Auth::user()->id);
        $user->phone = $this->removeCCprefix($user->phone);
        $genders = Gender::get();
        return view('profile.show', compact('user', 'genders'));
    }
    public function customerUpdateProfile(Request $req)
    {
        $user = User::find(Auth::user()->id);

        // original data
        $originalData = [
            'name' => $user->name,
            'phone' => $this->removeCCprefix($user->phone),
            'gender_id' => $user->gender_id,
            'address' => $user->address,
        ];
        // incoming data
        $incomingData = $req->only(array_keys($originalData));

        // Compare incoming data with original data
        if ($originalData == $incomingData) {
            return redirect()->back()->with('status', 'Nothing Updated.');
        }

        $credentials = $req->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:users|numeric|regex:/^1[3-9][0-9]{8}$/',
            'gender_id' => 'required',
            'address' => 'required|string|max:255'
        ]);

        $user->update([
            'name' => $credentials['name'],
            'phone' => "+880" . $credentials['phone'],
            'gender_id' => $credentials['gender_id'],
            'address' => $credentials['address'],
        ]);

        if ($req->hasFile('profile_picture')) {
            $old_profile_picture = public_path("storage/") . $user->profile_picture;

            if (file_exists($old_profile_picture)) {
                @unlink($old_profile_picture);
            }

            $profile_picture = $req->validate([
                'profile_picture' => 'image|max:3000'
            ]);

            $path = $profile_picture['profile_picture']->store('images', 'public');

            $user->update([
                'profile_picture' => $path
            ]);
            return redirect()->back()->with('status', 'Successfully Updated.');
        }
        return redirect()->back()->with('status', 'Successfully Updated.');
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
