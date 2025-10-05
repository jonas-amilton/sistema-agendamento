<?php

namespace App\Http\Controllers\Patient\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('patient.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // dd($credentials);

        // dd(Auth::guard('patients')->attempt($credentials));

        if (Auth::guard('patients')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('patient.dashboard'));
        }

        // if (Auth::guard('patients')->attempt($credentials, $request->boolean('remember'))) {
        //     $request->session()->regenerate();

        //     return redirect()->intended(route('patient.dashboard'));
        // }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('patients')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('patient.login');
    }
}