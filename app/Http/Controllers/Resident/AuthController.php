<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.resident_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nik' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::guard('resident')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('warga.dashboard');
        }

        return back()->with('error', 'Login gagal! NIK atau password salah.')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('resident')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('warga.login');
    }
}