<?php

namespace App\Repositories;

use App\Interfaces\IUserRepository;
use App\Models\User;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class UserRepository implements IUserRepository
{
    public function findByGoogleId(string $googleId): ?User
    {
        return User::where('googleId', $googleId)->first();
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function createFromGoogle(SocialiteUser $socialiteUser): User
    {
        $user = User::create([
            'name' => $socialiteUser->getName(),
            'email' => $socialiteUser->getEmail(),
            'googleId' => $socialiteUser->getId(),
            'email_verified_at' => now(),
        ]);

        $user->assignRole('player');

        return $user;
    }

    public function linkGoogleAccount(User $user, string $googleId): User
    {
        $user->update(['googleId' => $googleId]);

        return $user;
    }
}
