<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required|string',
        ]);

        $correo = $validated['correo'];
        $password = $validated['contrasena'];
        $remember = $request->has('remember');
        $key = 'login:account:' . sha1(strtolower($correo) . '|' . $request->ip());
        $ipKey = 'login:ip:' . sha1($request->ip());

        if (RateLimiter::tooManyAttempts($key, 5) || RateLimiter::tooManyAttempts($ipKey, 10)) {
            $secondsRemaining = max(RateLimiter::availableIn($key), RateLimiter::availableIn($ipKey));
            return back()->withErrors(['correo' => "Demasiados intentos. Intenta de nuevo en $secondsRemaining segundos."])
                ->withInput($request->only('correo'));
        }

        $credentials = ['correo' => $correo, 'password' => $password];

        if (auth('usuarios')->attempt($credentials, $remember)) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            $rol_id = auth('usuarios')->user()->rol_id;
            switch ($rol_id) {
                case 1:
                    return redirect()->route('admin.home');
                case 2:
                    return redirect()->route('dentista.home');
                case 3:
                    return redirect()->route('paciente.home');
                default:
                    return redirect()->route('login');
            }
        } else {
            RateLimiter::hit($key, 60);
            RateLimiter::hit($ipKey, 60);
            $attemptsRemaining = min(RateLimiter::remaining($key, 5), RateLimiter::remaining($ipKey, 10));

            return back()
                ->withErrors(['correo' => 'Credenciales incorrectas'])
                ->withInput($request->only('correo'))
                ->with('attempts_remaining', $attemptsRemaining);
        }
    }

    public function logout()
    {
        auth('usuarios')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
