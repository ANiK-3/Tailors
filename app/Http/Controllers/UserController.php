<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
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
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        $genders = Gender::get();
        return view('admin.users.create', compact('roles', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $credentials = $req->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|exists:roles,id',
            'gender' => 'required|exists:genders,id',
            'phone' => 'required|numeric|regex:/^1[3-9][0-9]{8}$/|unique:users',
            'address' => 'required|string|max:255'
        ]);

        $countryCode = "+880";
        $credentials['phone'] = $countryCode . $credentials['phone'];
        $role = $credentials['role'];
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'phone' => $credentials['phone'],
            'gender_id' => $credentials['gender'],
            'address' => $credentials['address'],
            'email_verified_at' => now(),
        ]);
        if (!$user) {
            redirect()->back()->with('error', 'Unable to create an account.');
        }
        // Attach roles to the user
        $user->roles()->attach($role);

        // if the user is tailor
        if ($role == 3) {
            $user->tailor()->create([
                'specialization' => 'custom',
            ]);
        }

        redirect()->route('users.create')->with('success', 'Successfully created an account');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $genders = Gender::get();
        $user->phone = $this->removeCCprefix($user->phone);
        return view('admin.users.edit', compact('user', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, User $user)
    {
        $credentials = $req->validate([
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|unique:users|numeric|regex:/^1[3-9][0-9]{8}$/',
            'gender_id' => 'required',
            'address' => 'required|string|max:255',
            'profile_picture' => 'image|max:3000'
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

            $path = $credentials['profile_picture']->store('images', 'public');

            $user->update([
                'profile_picture' => $path
            ]);
            return redirect()->back()->with('success', 'Successfully Updated.');
        }
        return redirect()->back()->with('success', 'Successfully Updated.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        redirect()->back()->with('success', 'Successfully deleted');
        // if ($user->delete()) {
        //     response()->json(['succes' => 'Succesfully deleted']);
        // } else {
        //     response()->json(['error' => 'Unable to delete']);
        // }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logout Successful');
    }

    public function getUser(Request $req)
    {
        $name = $req->query('name', '');
        $role = $req->query('role', '');

        $query = User::query();

        if ($name) {
            $query->where('name', 'like', "{$name}%");
        }

        // Filter users by role, excluding 'Admin'
        if ($role) {
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('role', '!=', 'Admin')->where('role', ucfirst($role));
            });
        } else {
            $query->whereDoesntHave('roles', function ($query) {
                $query->where('role', 'Admin');
            })->orderBy('name');
        }

        $users = $query->paginate(10);

        if ($users->isEmpty()) {
            return response()->json([
                "message" => "User Not Found",
            ], 404);
        } else {
            return response()->json([
                "users" => $users,
                "pagination" => $users->links()->render()
            ]);
        }
    }
    public function defaultDashboard()
    {
        return view('default');
    }
    public function removeCCprefix($phone)
    {
        // Remove the country code prefix
        if (strpos($phone, '+880') === 0) {
            return $phone = substr($phone, 4);
        }
    }
}
