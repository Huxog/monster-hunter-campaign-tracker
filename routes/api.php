<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HunterController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MonsterController;
use App\Http\Controllers\QuestController;
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

    // Read operations - any authenticated user
    Route::apiResource('maps', MapController::class)->only(['index', 'show']);
    Route::apiResource('campaigns', CampaignController::class)->only(['index', 'show']);
    Route::apiResource('hunters', HunterController::class)->only(['index', 'show']);
    Route::apiResource('equipment', EquipmentController::class)->only(['index', 'show']);
    Route::apiResource('weapons', WeaponController::class)->only(['index', 'show']);
    Route::apiResource('materials', MaterialController::class)->only(['index', 'show']);
    Route::apiResource('monsters', MonsterController::class)->only(['index', 'show']);
    Route::apiResource('quests', QuestController::class)->only(['index', 'show']);
    Route::post('hunters/{hunter}/craft', [HunterController::class, 'craft']);

    // Write operations - admin only
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('maps', MapController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('campaigns', CampaignController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('hunters', HunterController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('equipment', EquipmentController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('weapons', WeaponController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('materials', MaterialController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('monsters', MonsterController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('quests', QuestController::class)->only(['store', 'update', 'destroy']);
    });
});
