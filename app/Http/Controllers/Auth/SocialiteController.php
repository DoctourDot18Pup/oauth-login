<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Error al autenticar con ' . $provider);
        }

        $user = User::updateOrCreate(
            [
                'provider'    => $provider,
                'provider_id' => $socialUser->getId(),
            ],
            [
                'name'   => $socialUser->getName() ?? $socialUser->getNickname(),
                'email'  => $socialUser->getEmail(),
                'avatar' => $socialUser->getAvatar(),
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}