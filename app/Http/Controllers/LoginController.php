<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request, Redirector $redirect)
    {
        $remember = $request->filled('remember');

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            $request->session()->regenerate();

            return $redirect->intended('dashboard')->with('status', 'Estas Logueado');
        }
        
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
            'password' => __('auth.password')
        ]);
    }

    public function logout(Request $request, Redirector $redirect)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $redirect->to('/')->with('status', 'Has cerrado sesión correctamente');
    }

    public function register(Request $request, Redirector $redirect)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if (!empty($user)) {
            return $redirect->to('/login')->with('status', 'El usuario se ha registrado correctamente');
        }

        throw ValidationException::withMessages([
            'email' => 'Error, ingresa un correo electronico ideal'
        ]);

    }
}
