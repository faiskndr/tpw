<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(TourPackage::with(['destination', 'packageImages'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'title' => 'required|string|max:200',
            'type' => 'required|in:open_trip,private_tur',
            'price' => 'required|numeric',
            'price_original' => 'nullable|numeric',
            'duration_days' => 'required|integer',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric',
            'review_count' => 'nullable|integer',
        ]);

        $package = TourPackage::create($request->all());
        return response()->json($package, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TourPackage $tourPackage)
    {

        return response()->json($tourPackage->load(['destination', 'packageImages', 'tourSchedules']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TourPackage $tourPackage)
    {
        $tourPackage->update($request->all());
        return response()->json($tourPackage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourPackage $tourPackage)
    {
        $tourPackage->delete();
        return response()->json(['message' => 'Paket wisata berhasil dihapus.']);
    }
}
