<?php

namespace App\Http\Controllers;

use App\Services\Auth\SocialAuthProviderInterface;
use Exception;

class SocialAuthController extends Controller
{
    public function __construct(
        protected SocialAuthProviderInterface $socialAuthService
    ) {}

    public function redirect()
    {
        return $this->socialAuthService->redirect();
    }

    public function callback()
    {
        try {
            $this->socialAuthService->handleCallback();
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }

        return redirect()->route('home');
    }
}
