<?php

namespace App\Services;

use App\Interfaces\ILoggingService;
use Illuminate\Support\Facades\Log;

class LoggingService implements ILoggingService
{
    public function info(string $domain, string $message, array $context = []): void
    {
        Log::info($message, array_merge(['domain' => $domain], $context));
    }

    public function warning(string $domain, string $message, array $context = []): void
    {
        Log::warning($message, array_merge(['domain' => $domain], $context));
    }

    public function error(string $domain, string $message, array $context = []): void
    {
        Log::error($message, array_merge(['domain' => $domain], $context));
    }
}
