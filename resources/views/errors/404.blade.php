@extends('layouts.app')

@section('title', 'Página no encontrada')

@section('content')
<div class="text-center py-5">
    <h1 class="display-4">404</h1>
    <p class="lead mb-4">La página que buscas no existe.</p>
    <a href="{{ route('panel.home') }}" class="btn btn-primary">Ir al inicio</a>
</div>
@endsection
