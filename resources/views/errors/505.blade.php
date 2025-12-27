@extends('layouts.app')
@section('title','Error interno')
@section('content')
<div class="text-center py-5">
    <h1 class="display-4"> Error del servidor</h1>
    <p class="lead md-4"> Ha ocurrido un problema inesperado. Estamos trabajando paara solucionarlo</p>
    <a href="{{route('panel.home')}}" class="btn btn-primary"> Volver al inicio</a>
</div>
@endsection
