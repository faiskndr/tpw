<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PackageImage;
use Illuminate\Http\Request;

class PackageImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PackageImage::with('tourPackage')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tour_package_id' => 'required|exists:tour_packages,id',
            'image_url' => 'required|string',
            'is_cover' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $image = PackageImage::create($request->all());
        return response()->json($image, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageImage $packageImage)
    {
        return response()->json($packageImage->load('tourPackage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackageImage $packageImage)
    {
        $packageImage->update($request->all());
        return response()->json($packageImage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageImage $packageImage)
    {
        $packageImage->delete();
        return response()->json(['message' => 'Gambar paket berhasil dihapus.']);
    }
}
