<?php

namespace App\Interfaces;

use App\Models\User;

interface IGoogleAuthService
{
    public function getRedirectUrl(): string;

    public function handleCallback(): User;
}
