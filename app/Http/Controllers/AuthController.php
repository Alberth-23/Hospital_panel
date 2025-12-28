<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    $remember = $request->boolean('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // 1) ¿Es admin?
        $isAdmin = DB::table('user_roles')
            ->join('roles', 'roles.id', '=', 'user_roles.role_id')
            ->where('user_roles.user_id', $user->id)
            ->where('roles.name', 'admin')
            ->exists();

        if ($isAdmin) {
            $route = 'admin.dashboard';
        } elseif ($user->patient) {
            // 2) ¿Es paciente (tiene registro en patients)?
            $route = 'patient.dashboard';
        } else {
            // 3) Usuario normal sin rol especial
            $route = 'panel.home';
        }

        return redirect()
            ->route($route)
            ->with('message', 'Bienvenido, ' . $user->name)
            ->with('message_type', 'success');
    }

    return back()
        ->withErrors(['email' => 'Las credenciales no son válidas.'])
        ->onlyInput('email');
}

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:150'],
            'email'                 => ['required', 'email', 'max:150', 'unique:users,email'],
            'password'              => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $data['password'], // se hashea por el cast en User
        ]);

        // Crear registro básico de paciente vinculado a este usuario
        Patient::create([
            'user_id'    => $user->id,
            'first_name' => $data['name'],   // luego podrás separar nombre/apellido
            'last_name'  => '',
            'email'      => $data['email'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('patient.dashboard')
            ->with('message', 'Bienvenido, ' . $user->name)
            ->with('message_type', 'success');
    }

    public function logout(Request $request)
    {
        $name = $request->user()->name;

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('panel.home')
            ->with('message', 'Hasta luego, ' . $name)
            ->with('message_type', 'info');
    }


}
