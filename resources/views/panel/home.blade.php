@extends('layouts.app')

@section('title', 'Inicio - Panel Pacientes')

@section('content')
<div class="p-5 mb-5 bg-light rounded-3 shadow-sm">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold">Bienvenido al Panel de Información para Pacientes</h1>
            <p class="lead mt-3">
                Aquí encontrarás información clara y actualizada sobre nuestros servicios,
                horarios de atención, ubicación y respuestas a las preguntas más frecuentes.
            </p>
            <a href="{{ route('panel.servicios') }}" class="btn btn-primary btn-lg me-2 mt-2">
                Ver servicios
            </a>
            <a href="{{ route('panel.contacto') }}" class="btn btn-outline-secondary btn-lg mt-2">
                Contacto y ubicación
            </a>
        </div>
        <div class="col-md-4 d-none d-md-block">
            {{-- Aquí podría ir una imagen ilustrativa más adelante --}}
            <div class="bg-white rounded-3 p-4 shadow-sm text-center">
                <h5 class="mb-3">Horarios de atención</h5>
                <p class="mb-1"><strong>Consultas externas:</strong></p>
                <p class="mb-2">Lunes a viernes · 08:00 – 20:00</p>
                <p class="mb-1"><strong>Urgencias:</strong></p>
                <p class="mb-0">24 horas · 365 días del año</p>
            </div>
        </div>
    </div>
</div>

<h2 class="mb-4">Accesos rápidos</h2>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h3 class="card-title h4">Servicios</h3>
                <p class="card-text">
                    Conoce las especialidades médicas y servicios que ofrece el hospital.
                </p>
                <a href="{{ route('panel.servicios') }}" class="btn btn-primary">
                    Ver servicios
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h3 class="card-title h4">Preguntas frecuentes</h3>
                <p class="card-text">
                    Resolvemos las dudas más comunes de nuestros pacientes.
                </p>
                <a href="{{ route('panel.faq') }}" class="btn btn-outline-primary">
                    Ver preguntas
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h3 class="card-title h4">Contacto y ubicación</h3>
                <p class="card-text">
                    Encuentra nuestros datos de contacto, dirección y horarios de atención.
                </p>
                <a href="{{ route('panel.contacto') }}" class="btn btn-outline-secondary">
                    Ver contacto
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
