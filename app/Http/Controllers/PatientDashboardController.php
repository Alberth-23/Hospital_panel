<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Si no hay usuario autenticado, redirigimos a login
        if (! $user) {
            return redirect()
                ->route('login')
                ->with('message', 'Debes iniciar sesión para acceder al panel de paciente.')
                ->with('message_type', 'warning');
        }

        // Obtenemos el registro de paciente asociado a este usuario
        $patient = $user->patient;

        // Si no existe registro de paciente, no tiene permiso para este panel
        if (! $patient) {
            abort(403, 'No tienes permiso para acceder a este panel.');
        }

        $appointments = $patient->appointments()
            ->where('scheduled_start', '>=', now()->subDay())
            ->orderBy('scheduled_start', 'asc')
            ->take(5)
            ->get();

        $upcomingAppointmentsCount = $patient->appointments()
            ->where('scheduled_start', '>=', now())
            ->count();

        $clinicalRecords = $patient->clinicalRecords()
            ->orderBy('record_date', 'desc')
            ->take(5)
            ->get();

        return view('patient.dashboard', compact(
            'user',
            'patient',
            'appointments',
            'upcomingAppointmentsCount',
            'clinicalRecords'
        ));
    }
}
