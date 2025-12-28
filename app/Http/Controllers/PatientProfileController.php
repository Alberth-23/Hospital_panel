<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $patient = $user->patient;

        if (! $patient) {
            abort(403, 'No se encontró información de paciente asociada a este usuario.');
        }

        return view('patient.profile', compact('user', 'patient'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $patient = $user->patient;

        if (! $patient) {
            abort(403, 'No se encontró información de paciente asociada a este usuario.');
        }

        $data = $request->validate([
            'first_name'              => ['required', 'string', 'max:100'],
            'last_name'               => ['required', 'string', 'max:100'],
            'date_of_birth'           => ['nullable', 'date'],
            'gender'                  => ['nullable', 'string', 'max:20'],
            'document_type'           => ['nullable', 'string', 'max:30'],
            'document_number'         => ['nullable', 'string', 'max:50'],
            'phone'                   => ['nullable', 'string', 'max:30'],
            'address_line1'           => ['nullable', 'string', 'max:255'],
            'address_line2'           => ['nullable', 'string', 'max:255'],
            'city'                    => ['nullable', 'string', 'max:100'],
            'region'                  => ['nullable', 'string', 'max:100'],
            'postal_code'             => ['nullable', 'string', 'max:20'],
            'country'                 => ['nullable', 'string', 'max:100'],
            'emergency_contact_name'  => ['nullable', 'string', 'max:150'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:30'],
        ]);

        // Actualizar datos del paciente
        $patient->update($data);



        return redirect()
            ->route('patient.profile.edit')
            ->with('message', 'Tu perfil ha sido actualizado correctamente.')
            ->with('message_type', 'success');
    }
}
