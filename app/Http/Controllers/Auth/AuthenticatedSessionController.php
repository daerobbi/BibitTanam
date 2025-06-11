<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $user = Auth::user();

    // Cek status akun
    if ($user->status_akun === 0) {
        Auth::logout();
        return redirect()->back()->with('error', 'Verivikasi akun anda ditolak oleh admin.');
    }

    if (is_null($user->status_akun)) {
        Auth::logout();
        return redirect()->back()->with('error', 'Akun anda masih belum diverivikasi admin. Coba lagi nanti.');
    }

    session()->regenerate();

    // Redirect berdasarkan role user
    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.beranda');
        case 'agen':
            return redirect()->route('agen.beranda');
        case 'rekantani':
            return redirect()->route('rekantani.beranda');
        default:
            return redirect()->route('home'); // fallback
    }
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
