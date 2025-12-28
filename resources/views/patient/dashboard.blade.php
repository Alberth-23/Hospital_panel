@extends('layouts.patient')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Mi panel de paciente')

@section('content')
<div class="mb-4">
    <h1 class="h3 mb-1">Hola, {{ $user->name }}</h1>
    <p class="text-muted mb-0">
        Este es tu panel personal como paciente. Aquí podrás ver un resumen de tus datos y actividad.
    </p>
</div>

@if (! $patient)
    <div class="alert alert-warning">
        No se encontró información de paciente asociada a tu usuario.
        Contacta con el hospital para completar tu perfil.
    </div>
    @return
@endif

<a href="{{ route('patient.profile.edit') }}" class="btn btn-outline-primary btn-sm">
    Editar perfil
</a>

<div class="row mb-4">
    <!-- Resumen del paciente -->
    <div class="col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h2 class="h5 mb-3">Datos personales</h2>
                <p class="mb-1">
                    <strong>Nombre:</strong>
                    {{ $patient->first_name }} {{ $patient->last_name }}
                </p>

                @if($patient->date_of_birth)
                    <p class="mb-1">
                        <strong>Fecha de nacimiento:</strong>
                        {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d/m/Y') }}
                    </p>
                @endif

                @if($patient->document_number)
                    <p class="mb-1">
                        <strong>Documento:</strong>
                        {{ $patient->document_type }} {{ $patient->document_number }}
                    </p>
                @endif

                @if($patient->phone)
                    <p class="mb-1">
                        <strong>Teléfono:</strong> {{ $patient->phone }}
                    </p>
                @endif

                @if($patient->email)
                    <p class="mb-1">
                        <strong>Email:</strong> {{ $patient->email }}
                    </p>
                @endif

                @if($patient->city || $patient->country)
                    <p class="mb-0">
                        <strong>Ubicación:</strong>
                        {{ $patient->city }} {{ $patient->region }} {{ $patient->country }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    <!-- Contacto de emergencia -->
    <div class="col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h2 class="h5 mb-3">Contacto de emergencia</h2>

                @if($patient->emergency_contact_name)
                    <p class="mb-1">
                        <strong>Nombre:</strong> {{ $patient->emergency_contact_name }}
                    </p>
                    <p class="mb-0">
                        <strong>Teléfono:</strong> {{ $patient->emergency_contact_phone }}
                    </p>
                @else
                    <p class="text-muted mb-2">
                        Aún no has indicado un contacto de emergencia.
                    </p>
                @endif

                <p class="small text-muted mt-3 mb-0">
                    Esta información es importante para que el hospital pueda contactar con alguien de confianza
                    en caso de necesidad.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Próximas citas -->
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 mb-0">Próximas citas</h2>
                    <span class="badge bg-primary">
                        {{ $upcomingAppointmentsCount }} programada{{ $upcomingAppointmentsCount === 1 ? '' : 's' }}
                    </span>
                </div>

                @if($appointments->isEmpty())
                    <p class="text-muted mb-0">
                        No tienes citas programadas. Si necesitas una cita, contacta con el hospital.
                    </p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach ($appointments as $appointment)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>
                                            {{ $appointment->scheduled_start->format('d/m/Y H:i') }}
                                        </strong><br>
                                        @if($appointment->reason)
                                            <span class="text-muted">
                                                Motivo: {{ Str::limit($appointment->reason, 80) }}
                                            </span>
                                        @endif
                                    </div>
                                    <span class="badge bg-secondary align-self-start">
                                        {{ $appointment->status }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <!-- Últimos registros clínicos -->
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h2 class="h5 mb-3">Últimos registros clínicos</h2>

                @if($clinicalRecords->isEmpty())
                    <p class="text-muted mb-0">
                        Todavía no hay registros clínicos asociados a tu historial en el sistema.
                    </p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach ($clinicalRecords as $record)
                            <li class="list-group-item">
                                <strong>{{ $record->record_date->format('d/m/Y H:i') }}</strong><br>
                                {{ Str::limit($record->summary, 100) }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
