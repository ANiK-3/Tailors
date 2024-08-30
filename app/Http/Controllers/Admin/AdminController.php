<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tailor;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function manageShop()
    {
        return view('admin.shop.manage_shop');
    }
    public function manageRequest()
    {
        $tailors = Tailor::where('accepted_by_admin', 0)->get();
        return view('admin.shop.manage_request', compact('tailors'));
    }

    public function showTailor($id)
    {
        $tailor = Tailor::find($id);
        return view('admin.shop.show_tailor', compact('tailor'));
    }

    public function acceptRequest($id)
    {
        $tailor = Tailor::find($id);
        $tailor->update([
            'accepted_by_admin' => 1
        ]);
        return redirect()->back()->with('success', 'Successfully accepted');
    }
    public function declineRequest($id)
    {
        $tailor = Tailor::find($id);
        $tailor->update([
            'accepted_by_admin' => 0
        ]);
        return redirect()->back()->with('success', 'Request declined');
    }

    public function showCreateShop()
    {
        $tailors = Tailor::where('shop_name', null)->get();
        return view('admin.shop.create', compact('tailors'));
    }
    public function CreateShop(Request $req)
    {
        $shopData = $req->validate([
            'tailor_id' => 'required|exists:tailors,id',
            'shop_image' => 'image|max:3000',
            'shop_name' => 'required|string|min:2|max:255',
            'bio' => 'required|string|min:2',
        ]);

        $shopData['tailor_id'] = $req->tailor_id;
        $tailor = Tailor::find($shopData['tailor_id']);

        $tailor->update([
            'shop_name' => $shopData['shop_name'],
            'bio' => $shopData['bio'],
        ]);

        if ($req->hasFile('shop_image')) {
            $old_shop_image = public_path("storage/") . $tailor->shop_image;

            if (file_exists($old_shop_image)) {
                @unlink($old_shop_image);
            }

            $path = $shopData['profile_picture']->store('images', 'public');

            $tailor->update([
                'shop_image' => $path,
            ]);
            return redirect()->back()->with('success', 'Successfully Created.');
        }
        return redirect()->back()->with('success', 'Successfully Created');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
