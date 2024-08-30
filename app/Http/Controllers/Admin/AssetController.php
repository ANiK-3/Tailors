<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;


class AssetController extends Controller
{
    public function index(){
        $assets = Asset::get();
        return view('admin.asset.show', compact('assets'));
    }

    public function showUploadForm()
    {
        return view('admin.asset.upload');
    }

    public function upload(Request $request)
    {
        $validatedAsset = $request->validate([
            'asset' => 'required|file|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'asset_type' => 'required|string|max:50',
        ]);

        $file = $validatedAsset['asset'];
        $fileName = $file->getClientOriginalName();
        // $fileName = time() . '-' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        Asset::create([
            'asset_type' => $validatedAsset['asset_type'],
            'file_name' => $fileName,
            'file_path' => $filePath,
        ]);

        return back()->with('success', 'File uploaded successfully!');
    }

    public function show()
    {
        $assets = Asset::get();
        return view('admin.asset.show', compact('assets'));
    }
}
