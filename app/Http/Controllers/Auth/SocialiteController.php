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
            return redirect('/login')->with('error', 'Error al autenticar con ' . $provider);
        }

        // Buscar primero por provider + provider_id
        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        if (!$user) {
            // Buscar por email si ya existe de otro proveedor
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // Actualizar con el nuevo proveedor
                $user->update([
                    'provider'    => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar'      => $socialUser->getAvatar(),
                ]);
            } else {
                // Crear nuevo usuario
                $user = User::create([
                    'name'        => $socialUser->getName() ?? $socialUser->getNickname(),
                    'email'       => $socialUser->getEmail(),
                    'avatar'      => $socialUser->getAvatar(),
                    'provider'    => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            }
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}