<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->stateless()
            ->scopes(['openid', 'profile', 'email'])
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function callback(Request $request)
    {
        if ($request->filled('error')) {
            Log::warning('Google OAuth denied by user/provider', $request->only([
                'error', 'error_description',
            ]));

            return redirect()->route('admin.login')
                ->withErrors([
                    'email' => 'Google menolak login: ' . ($request->get('error_description') ?: $request->get('error')),
                ]);
        }

        if (!$request->filled('code')) {
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Kode OAuth Google tidak diterima. Coba login lagi.']);
        }

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Throwable $e) {
            Log::error('Google OAuth token exchange failed', [
                'message' => $e->getMessage(),
                'exception' => $e::class,
                'redirect_cfg' => config('services.google.redirect'),
                'client_id_set' => (bool) config('services.google.client_id'),
                'secret_set' => (bool) config('services.google.client_secret'),
            ]);

            return redirect()->route('admin.login')
                ->withErrors([
                    'email' => 'Login Google gagal: ' . $e->getMessage(),
                ]);
        }

        $email = strtolower(trim((string) $googleUser->getEmail()));

        if ($email === '') {
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Email Google tidak tersedia / tidak di-share.']);
        }

        $admin = Admin::query()
            ->whereRaw('LOWER(email) = ?', [$email])
            ->first();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Email ' . $email . ' tidak terdaftar sebagai admin.']);
        }

        $admin->forceFill([
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
            'name' => $admin->name ?: ($googleUser->getName() ?? $admin->name),
        ])->save();

        Auth::guard('admin')->login($admin, true);
        $request->session()->regenerate();

        try {
            ActivityLog::record('login', 'Login via Google: ' . $admin->email);
        } catch (\Throwable $e) {
            Log::warning('Failed to write login activity log', ['message' => $e->getMessage()]);
        }

        return redirect()->intended(route('admin.dashboard'));
    }
}
