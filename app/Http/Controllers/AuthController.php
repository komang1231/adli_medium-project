<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Halaman Login
     */
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * Proses Login
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'Active',
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()
                ->route('dashboard.index')
                ->with('success', 'Login berhasil.');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah, atau akun tidak aktif.',
            ])
            ->onlyInput('email');
    }

    /**
     * Logout
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Berhasil logout.');
    }
}
