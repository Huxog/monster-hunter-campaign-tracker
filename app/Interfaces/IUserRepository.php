<?php

namespace App\Interfaces;

use App\Models\User;
use Laravel\Socialite\Contracts\User as SocialiteUser;

interface IUserRepository
{
    public function findByGoogleId(string $googleId): ?User;

    public function findByEmail(string $email): ?User;

    public function createFromGoogle(SocialiteUser $socialiteUser): User;

    public function linkGoogleAccount(User $user, string $googleId): User;
}
