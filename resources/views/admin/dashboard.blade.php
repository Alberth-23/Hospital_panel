@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Panel de administración')

@section('content')
{{-- Tarjetas de métricas principales --}}
<div class="row mb-4 g-3">
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted text-uppercase mb-2">Usuarios</h6>
                <p class="display-6 mb-0">{{ $stats['total_users'] }}</p>
                <small class="text-muted">Usuarios con acceso al sistema</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted text-uppercase mb-2">Pacientes</h6>
                <p class="display-6 mb-0">{{ $stats['total_patients'] }}</p>
                <small class="text-muted">
                    Registros de pacientes<br>
                    ({{ $newPatientsLast7Days }} nuevos últimos 7 días)
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted text-uppercase mb-2">Citas hoy</h6>
                <p class="display-6 mb-0">{{ $stats['today_appointments'] }}</p>
                <small class="text-muted">Citas programadas para hoy</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted text-uppercase mb-2">Registros clínicos</h6>
                <p class="display-6 mb-0">{{ $stats['total_records'] }}</p>
                <small class="text-muted">Entradas en historias clínicas</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    {{-- Usuarios por rol --}}
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">Usuarios por rol</h5>

                @if ($usersByRole->isEmpty())
                    <p class="text-muted mb-0">No se han asignado roles aún.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach ($usersByRole as $row)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ ucfirst($row->name) }}</span>
                                <span class="badge bg-primary rounded-pill">{{ $row->total }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    {{-- Citas de hoy por estado --}}
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">Citas de hoy por estado</h5>

                @if ($appointmentsTodayByStatus->isEmpty())
                    <p class="text-muted mb-0">No hay citas programadas para hoy.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Estado</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointmentsTodayByStatus as $row)
                                    <tr>
                                        <td>{{ $row->status }}</td>
                                        <td>{{ $row->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Últimos pacientes --}}
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">Últimos pacientes registrados</h5>

                @if ($latestPatients->isEmpty())
                    <p class="text-muted mb-0">Aún no hay pacientes registrados.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Teléfono</th>
                                    <th>Fecha alta</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestPatients as $patient)
                                    <tr>
                                        <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                                        <td>
                                            @if ($patient->document_number)
                                                {{ $patient->document_type }} {{ $patient->document_number }}
                                            @else
                                                <span class="text-muted">N/D</span>
                                            @endif
                                        </td>
                                        <td>{{ $patient->phone ?? 'N/D' }}</td>
                                        <td>{{ optional($patient->created_at)->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Próximas citas --}}
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">Próximas citas</h5>

                @if ($upcomingAppointments->isEmpty())
                    <p class="text-muted mb-0">No hay citas programadas próximamente.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Fecha y hora</th>
                                    <th>Paciente</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($upcomingAppointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->scheduled_start->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if ($appointment->patient)
                                                {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}
                                            @else
                                                <span class="text-muted">N/D</span>
                                            @endif
                                        </td>
                                        <td>{{ $appointment->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
