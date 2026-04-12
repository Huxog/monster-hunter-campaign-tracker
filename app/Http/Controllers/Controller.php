<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    protected function perPage(Request $request, int $default = 15, int $max = 100): int
    {
        return min(max(1, (int) $request->input('per_page', $default)), $max);
    }
}