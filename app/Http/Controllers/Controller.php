<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    protected function perPage(Request $request, int $default = 15, int $max = 100): int
    {
        $value = (int) $request->input('per_page', $default);

        if ($value === 0) {
            return 0;
        }

        return min(max(1, $value), $max);
    }

    /**
     * Returns the authenticated user's ID when they are a player,
     * or null when they are an admin. Used to scope index queries
     * so players only see their own data while admins see everything.
     */
    protected function scopedUserId(): ?string
    {
        $user = auth()->user();

        return $user->hasRole('admin') ? null : $user->id;
    }
}
