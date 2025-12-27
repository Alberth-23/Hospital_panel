@extends('layouts.app')
@section('title', 'Informacion para el paciente')
@section('content')

<h1 class="mb-4" > Informacion para el paciente </h1>
<p class="mb-4">
    En esta seccion encontraras recomendaciones generales para recuperar tus citas y visitas al hospital.
</p>

<h2 class="h4"> Antes de tu cita </h2>

<ul>
    <li>Llega con al menos 15 minutos de anticipacion.</li>
    <li>Lleva tu documento de indetidad y, si aplica , tarjeta de seguro médico.</li>
    <li>Trae informes médicos anteriores, listados de medicamentos y alergias.</li>
</ul>

<h2 class="h4 mt-4"> Para estudios y análisis</h2>
<ul>
    <li> Sigue las indicaciones de ayuno si tu prueba lo requiere.</li>
    <li> No olvides informar si estas tomando medición cronica</li>
</ul>

<h2 class="h4 mt-4"> Urgencias </h2>
<p>
    Ante cualquier situacion que consideras una urgencia, acude directametne al servicio de urgencias o llama al numero de urgencias de tu zona.
</p>
@endsection
