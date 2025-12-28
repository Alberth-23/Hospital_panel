<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view( 'auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request-> validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request -> boolean ('remember');

        if (Auth::attempt($credentials, $remember)){
            $request-> session()->regenerate();

            return redirect()->intended(route('panel.home'));
        }

        return back()
        ->whithErrors(['email' => 'Las credenciales no son válidas.'])
        ->onlyInput('email');

    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data  = $request->validate([
            'name'                  => ['required','string','max:150'],
            'email'                 => ['required','email','max:150', 'unique:users,email'],
            'password'              => ['required','min:8','confirmed'],

        ]);

        //las contraseñas se encriptan en modo hashs

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('panel.home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return redirect()->route('panel.home');
    }
}
