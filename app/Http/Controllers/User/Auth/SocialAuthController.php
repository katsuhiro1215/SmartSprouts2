<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if (!$user) {
                $user = User::create([
                    'username' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(16)),
                    'google_id' => $googleUser->getId(),
                    'provider' => 'google',
                ]);
            }

            Auth::login($user);

            return to_route('user.welcome')->with([
                'success' => 'ログインしました。',
                'status' => 'success'
            ]);
        } catch (\Throwable $e) {
            Log::error($e);

            return to_route('user.login')->with([
                'success' => 'ログインに失敗しました。',
                'status' => 'error'
            ]);
        }
    }
}
