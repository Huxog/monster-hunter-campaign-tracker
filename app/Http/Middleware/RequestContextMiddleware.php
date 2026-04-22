<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RequestContextMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $requestId = Str::uuid()->toString();

        Log::withContext(['requestId' => $requestId]);

        $response = $next($request);

        $userId = Auth::id();

        Log::withContext(array_filter(['userId' => $userId]));

        Log::info('incoming request', [
            'method' => $request->method(),
            'path' => $request->path(),
        ]);

        $response->headers->set('X-Request-Id', $requestId);

        return $response;
    }
}
