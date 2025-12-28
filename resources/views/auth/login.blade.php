@extends('layouts.app')
@section('title', 'Iniciar sesión')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h1 class="h4 mb-3 text-center">Iniciar sesión</h1>
                <p class="text-muted text-center mb-4">
                    Accede al panel del hospital con tus credenciales.
                </p>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $erros)
                            <li>{{$errors}}</li>
                        @endforeach
                 </ul>
                </div>

                @endif

                <form  method="POST" action="{{ route('login.post')}}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label"> Correo Electronico</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email')}}"
                            required
                            autofocus
                            >
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"> CONTRASEÑA </label>
                        <input type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        value="{{old('password')}}"
                        required
                        autofocus
                        >
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror

                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Recordarme en ese dispositivo
                        </label>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">
                            Iniciar sesió
                        </button>
                    </div>

                    <p class="text-center mb-0">
                        ¿no tienes una cuenta?
                        <a href="{{route('register')}}"> Registrarse</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
