<?php

namespace App\Http\Controllers;

use App\Interfaces\IHealthService;
use Illuminate\Http\JsonResponse;

class HealthController extends Controller
{
    public function __construct(private IHealthService $healthService) {}

    public function check(): JsonResponse
    {
        $result = $this->healthService->check();
        $status = $result['status'] === 'ok'
            ? JsonResponse::HTTP_OK
            : JsonResponse::HTTP_SERVICE_UNAVAILABLE;

        return response()->json($result, $status);
    }
}
