<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\TourSchedule;
use Illuminate\Http\Request;

class TourScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TourSchedule::with(['tourPackage.packageImageCover'])->get()->toResourceCollection();
        
        return ResponseHelper::SuccessResponse($data, "success get tour schedules data");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tour_package_id' => 'required|exists:tour_packages,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'quota' => 'required|integer|min:1',
        ]);

        $schedule = TourSchedule::create($request->all());
        return response()->json($schedule, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TourSchedule $tourSchedule)
    {
        return response()->json($tourSchedule->load(['tourPackage']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TourSchedule $tourSchedule)
    {
        $tourSchedule->update($request->all());
        return response()->json($tourSchedule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourSchedule $tourSchedule)
    {
        $tourSchedule->delete();
        return response()->json(['message' => 'Jadwal  berhasil dihapus.']);
    }
}
