<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HunterController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\WeaponController;
use Illuminate\Support\Facades\Route;

// Public auth routes
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);

    Route::apiResource('maps', MapController::class);
    Route::apiResource('campaigns', CampaignController::class);
    Route::apiResource('hunters', HunterController::class);
    Route::apiResource('equipment', EquipmentController::class);
    Route::apiResource('weapons', WeaponController::class);
    Route::apiResource('materials', MaterialController::class);
});
