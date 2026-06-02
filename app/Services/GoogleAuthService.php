<?php

namespace App\Services;

use App\Interfaces\IGoogleAuthService;
use App\Interfaces\IUserRepository;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthService implements IGoogleAuthService
{
    public function __construct(private readonly IUserRepository $users) {}

    public function getRedirectUrl(): string
    {
        return Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
    }

    public function handleCallback(): User
    {
        $socialiteUser = Socialite::driver('google')->stateless()->user();

        $user = $this->users->findByGoogleId($socialiteUser->getId());

        if ($user) {
            return $user;
        }

        $existing = $this->users->findByEmail($socialiteUser->getEmail());

        if ($existing) {
            return $this->users->linkGoogleAccount($existing, $socialiteUser->getId());
        }

        return $this->users->createFromGoogle($socialiteUser);
    }
}
