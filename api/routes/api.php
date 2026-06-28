<?php

use App\Http\Controllers\Api\AboutContentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\PackageImageController;
use App\Http\Controllers\Api\TourPackageController;
use App\Http\Controllers\Api\TourScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// public routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// protected routes 
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });


    Route::apiResource('destinations', DestinationController::class);
    Route::apiResource('tour-packages', TourPackageController::class);
    Route::apiResource('package-images', PackageImageController::class);
    Route::apiResource('tour-schedules', TourScheduleController::class);
    Route::apiResource('about-contents', AboutContentController::class);
});
