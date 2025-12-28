<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel de administración') - Hospital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        .admin-sidebar {
            min-height: 100vh;
            background-color: #0f172a;
            color: #e5e7eb;
        }
        .admin-sidebar a {
            color: #e5e7eb;
            text-decoration: none;
        }
        .admin-sidebar a.active,
        .admin-sidebar a:hover {
            background-color: #1d4ed8;
        }
        .admin-brand {
            font-weight: 700;
            font-size: 1.2rem;
        }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">
        {{-- Sidebar --}}
        <nav class="col-md-3 col-lg-2 d-md-block admin-sidebar p-3">
            <div class="d-flex flex-column h-100">
                <div>
                    <div class="admin-brand mb-3">
                        Hospital · Admin
                    </div>
                    <hr class="border-secondary">

                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item mb-1">
                            <a href="{{ route('admin.dashboard') }}"
                               class="nav-link py-2 px-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                Dashboard
                            </a>
                        </li>
                        {{-- Menús futuros --}}
                    </ul>
                </div>

                <div class="mt-3 border-top border-secondary pt-3 small">
                    <div class="mb-2">
                        Conectado como:<br>
                        <strong>{{ Auth::user()->name }}</strong>
                    </div>
                    <a href="{{ route('panel.home') }}" class="d-block mb-2 text-decoration-underline">
                        Ver sitio público
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-light btn-sm w-100" type="submit">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        {{-- Contenido principal --}}
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <h1 class="h3 mb-3">@yield('page_title', 'Dashboard')</h1>

            @if (session('message'))
                <div class="alert alert-{{ session('message_type', 'success') }} alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
