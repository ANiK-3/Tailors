<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeasurementsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Gender;
use App\Models\Tailor;

class CustomerController extends Controller
{
    public function customerDashboard()
    {
        $tailors = Tailor::get();
        return view('index', compact('tailors'));
        // return view('customer.dashboard');
    }
    public function Profile()
    {
        if (Gate::denies('view_profile', Auth::user()->id)) {
            abort(401);
        }
        $user = User::findOrFail(Auth::user()->id);
        $user->phone = $this->removeCCprefix($user->phone);
        $genders = Gender::get();
        return view('customer.profile', compact('user', 'genders'));
    }

    public function UpdateProfile(Request $req)
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
            'name' => 'required|string|max:255',
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

    public function removeCCprefix($phone)
    {
        // Remove the country code prefix
        if (strpos($phone, '+880') === 0) {
            return $phone = substr($phone, 4);
        }
    }
}
