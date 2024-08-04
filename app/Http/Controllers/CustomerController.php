<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeasurementsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Gender;
use App\Models\Tailor;
use App\Models\TailorType;


class CustomerController extends Controller
{
    public function customerDashboard()
    {
        $tailorTypes = TailorType::get();
        return view('index', compact('tailorTypes'));

        // return view('customer.dashboard');
    }
    public function profile()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('customer.profile', compact('user'));
    }

    public function showUpdateProfile()
    {
        if (Gate::denies('view_profile', Auth::user()->id)) {
            abort(401);
        }
        $user = User::findOrFail(Auth::user()->id);
        $user->phone = $this->removeCCprefix($user->phone);
        $genders = Gender::get();

        return view('customer.update_profile', compact('user', 'genders'));
    }

    public function updateProfile(Request $req)
    {
        $user = User::findOrFail(Auth::user()->id);

        // original data
        // $originalData = [
        //     'name' => $user->name,
        //     'phone' => $this->removeCCprefix($user->phone),
        //     'gender_id' => $user->gender_id,
        //     'address' => $user->address,
        //     'profile_picture' => $user->profile_picture,
        // ];
        // incoming data
        // $incomingData = $req->only(array_keys($originalData));

        // Compare incoming data with original data
        // if ($originalData == $incomingData) {
        //     return redirect()->back()->with('success', 'Nothing Updated.');
        // }

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

    public function showUpdatePassword()
    {
        return view('customer.update_password');
    }

    public function validateCurrentPassword(Request $request)
    {
        $password = $request->validate([
            'current_password' => 'required|string',
        ]);

        $user = Auth::user();

        if (Hash::check($password['current_password'], $user->password)) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false]);
        }
    }
    public function updatePassword(Request $req)
    {
        $password = $req->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password is correct
        if (!Hash::check($password['current_password'], $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        $user->update([
            'password' => $password['password']
        ]);
        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    public function getTailor(Request $req)
    {
        $name = $req->query('shop_name', '');
        $type = $req->query('type', '');

        $query = Tailor::query();

        if ($name) {
            $query->where('shop_name', 'like', "{$name}%");
        }

        if ($type) {
            $query->whereHas('tailorTypes', function ($q) use ($type) {
                $q->where('name', ucwords($type));
            });
        } else {
            $query->where('accepted_by_admin', 1)->orderBy('shop_name');
        }

        $tailors = $query->paginate(7);

        if ($tailors->isEmpty()) {
            return response()->json([
                "message" => "Tailor Not Found",
            ], 404);
        } else {
            return response()->json([
                "tailors" => $tailors,
            ]);
        }
    }
    public function removeCCprefix($phone)
    {
        // Remove the country code prefix
        if (strpos($phone, '+880') === 0) {
            return $phone = substr($phone, 4);
        }
    }
}
