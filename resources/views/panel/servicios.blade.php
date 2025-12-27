@extends('layouts.app')

@section('title', 'Servicios - Panel Pacientes')

@section('content')
<h1 class="mb-4">Servicios y especialidades</h1>

<p class="mb-4">
    A continuación encontrarás las principales especialidades médicas y servicios disponibles
    para nuestros pacientes. Para más información, puedes comunicarte con el hospital.
</p>

<div class="row">
    @foreach ($servicios as $servicio)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $servicio['nombre'] }}</h5>
                    <p class="card-text">{{ $servicio['descripcion'] }}</p>
                    <p class="text-muted mb-0">
                        <strong>Horario:</strong> {{ $servicio['horario'] }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
