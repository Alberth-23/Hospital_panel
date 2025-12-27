<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Hospital - Panel Pacientes')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Google Font opcional --}}
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Estilos propios --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('panel.home') }}">Hospital</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('panel.home') ? 'active' : '' }}"
                       href="{{ route('panel.home') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('panel.servicios') ? 'active' : '' }}"
                       href="{{ route('panel.servicios') }}">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('panel.faq') ? 'active' : '' }}"
                       href="{{ route('panel.faq') }}">Preguntas frecuentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('panel.contacto') ? 'active' : '' }}"
                       href="{{ route('panel.contacto') }}">Contacto</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('panel.informacion') ? 'active' : ''}}"
                        href="{{route('panel.informacion')}}"> Info paciente</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main class="container mb-4">
    @yield('content')
</main>

<footer class="footer py-3 mt-5">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div>
            &copy; {{ date('Y') }} Hospital. Todos los derechos reservados.
        </div>
        <div class="mt-2 mt-md-0">
            <span class="me-3">Información para pacientes</span>
            <span>Atención 24h en urgencias</span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
