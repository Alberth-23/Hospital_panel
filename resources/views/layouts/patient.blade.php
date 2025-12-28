<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel del paciente') - Hospital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background-color: #f3f4f6;
        }
        .patient-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg patient-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('patient.dashboard') }}">Hospital · Paciente</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#patientNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="patientNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('patient.dashboard') ? 'active' : '' }}"
                       href="{{ route('patient.dashboard') }}">
                        Mi panel
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('patient.profile.*') ? 'active' : '' }}"
                       href="{{ route('patient.profile.edit') }}">
                        Perfil
                    </a>
                </li>
                {{-- En el futuro podrías añadir: Citas, Historial, etc. --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('panel.home') }}">
                        Ver web pública
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm" type="submit">
                            Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if (session('message'))
        <div class="alert alert-{{ session('message_type', 'success') }} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @yield('content')
</main>

<footer class="py-3 mt-5 bg-white border-top">
    <div class="container d-flex justify-content-between small text-muted">
        <span>&copy; {{ date('Y') }} Hospital.</span>
        <span>Portal del paciente</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
