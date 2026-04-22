<?php

namespace App\Services;

use App\Interfaces\IHealthService;
use Illuminate\Support\Facades\DB;
use Throwable;

class HealthService implements IHealthService
{
    public function check(): array
    {
        $checks = [
            'database' => $this->checkDatabase(),
        ];

        return [
            'status' => in_array('error', $checks) ? 'degraded' : 'ok',
            'checks' => $checks,
        ];
    }

    private function checkDatabase(): string
    {
        try {
            DB::connection()->getPdo();

            return 'ok';
        } catch (Throwable) {
            return 'error';
        }
    }
}
