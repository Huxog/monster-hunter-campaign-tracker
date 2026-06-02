<?php

namespace App\Http\Controllers;

use App\Interfaces\IGoogleAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Two\InvalidStateException;

class GoogleAuthController extends Controller
{
    public function __construct(private readonly IGoogleAuthService $googleAuth) {}

    public function redirect(): JsonResponse
    {
        return response()->json([
            'url' => $this->googleAuth->getRedirectUrl(),
        ]);
    }

    public function callback(): RedirectResponse
    {
        $frontendUrl = config('app.frontend_url');

        try {
            $user = $this->googleAuth->handleCallback();
        } catch (InvalidStateException) {
            return redirect($frontendUrl.'/auth/callback?error=invalid_state');
        } catch (\Exception) {
            return redirect($frontendUrl.'/auth/callback?error=google_auth_failed');
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect($frontendUrl.'/auth/callback?token='.$token);
    }
}
