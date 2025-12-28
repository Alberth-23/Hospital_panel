@extends('layouts.patient')

@section('title', 'Mi perfil')

@section('content')
<div class="mb-4">
    <h1 class="h3 mb-1">Mi perfil</h1>
    <p class="text-muted mb-0">
        Actualiza tus datos personales y de contacto. Mantener esta información al día
        ayuda al hospital a comunicarse contigo de forma adecuada.
    </p>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" action="{{ route('patient.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="row g-4">
                {{-- Datos básicos --}}
                <div class="col-md-6">
                    <h2 class="h5 mb-3">Datos personales</h2>

                    <div class="mb-3">
                        <label class="form-label" for="first_name">Nombre</label>
                        <input type="text"
                               id="first_name"
                               name="first_name"
                               class="form-control @error('first_name') is-invalid @enderror"
                               value="{{ old('first_name', $patient->first_name) }}"
                               required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="last_name">Apellidos</label>
                        <input type="text"
                               id="last_name"
                               name="last_name"
                               class="form-control @error('last_name') is-invalid @enderror"
                               value="{{ old('last_name', $patient->last_name) }}"
                               required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="date_of_birth">Fecha de nacimiento</label>
                        <input type="date"
                               id="date_of_birth"
                               name="date_of_birth"
                               class="form-control @error('date_of_birth') is-invalid @enderror"
                               value="{{ old('date_of_birth', $patient->date_of_birth) }}">
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="gender">Género</label>
                        <select id="gender"
                                name="gender"
                                class="form-select @error('gender') is-invalid @enderror">
                            <option value="">No especificar</option>
                            <option value="Masculino" {{ old('gender', $patient->gender) === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ old('gender', $patient->gender) === 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="Otro" {{ old('gender', $patient->gender) === 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="document_type">Tipo de documento</label>
                        <input type="text"
                               id="document_type"
                               name="document_type"
                               class="form-control @error('document_type') is-invalid @enderror"
                               value="{{ old('document_type', $patient->document_type) }}"
                               placeholder="DNI, Pasaporte, etc.">
                        @error('document_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="document_number">Número de documento</label>
                        <input type="text"
                               id="document_number"
                               name="document_number"
                               class="form-control @error('document_number') is-invalid @enderror"
                               value="{{ old('document_number', $patient->document_number) }}">
                        @error('document_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Contacto y dirección --}}
                <div class="col-md-6">
                    <h2 class="h5 mb-3">Contacto y dirección</h2>

                    <div class="mb-3">
                        <label class="form-label" for="phone">Teléfono</label>
                        <input type="text"
                               id="phone"
                               name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $patient->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="address_line1">Dirección</label>
                        <input type="text"
                               id="address_line1"
                               name="address_line1"
                               class="form-control @error('address_line1') is-invalid @enderror"
                               value="{{ old('address_line1', $patient->address_line1) }}"
                               placeholder="Calle, número, piso">
                        @error('address_line1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="address_line2">Información adicional</label>
                        <input type="text"
                               id="address_line2"
                               name="address_line2"
                               class="form-control @error('address_line2') is-invalid @enderror"
                               value="{{ old('address_line2', $patient->address_line2) }}"
                               placeholder="Portal, referencia, etc.">
                        @error('address_line2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="city">Ciudad</label>
                            <input type="text"
                                   id="city"
                                   name="city"
                                   class="form-control @error('city') is-invalid @enderror"
                                   value="{{ old('city', $patient->city) }}">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="region">Provincia / Región</label>
                            <input type="text"
                                   id="region"
                                   name="region"
                                   class="form-control @error('region') is-invalid @enderror"
                                   value="{{ old('region', $patient->region) }}">
                            @error('region')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="postal_code">Código postal</label>
                            <input type="text"
                                   id="postal_code"
                                   name="postal_code"
                                   class="form-control @error('postal_code') is-invalid @enderror"
                                   value="{{ old('postal_code', $patient->postal_code) }}">
                            @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="country">País</label>
                            <input type="text"
                                   id="country"
                                   name="country"
                                   class="form-control @error('country') is-invalid @enderror"
                                   value="{{ old('country', $patient->country) }}">
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            {{-- Contacto de emergencia --}}
            <div class="row">
                <div class="col-md-6">
                    <h2 class="h5 mb-3">Contacto de emergencia</h2>

                    <div class="mb-3">
                        <label class="form-label" for="emergency_contact_name">Nombre del contacto</label>
                        <input type="text"
                               id="emergency_contact_name"
                               name="emergency_contact_name"
                               class="form-control @error('emergency_contact_name') is-invalid @enderror"
                               value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}">
                        @error('emergency_contact_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="emergency_contact_phone">Teléfono del contacto</label>
                        <input type="text"
                               id="emergency_contact_phone"
                               name="emergency_contact_phone"
                               class="form-control @error('emergency_contact_phone') is-invalid @enderror"
                               value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}">
                        @error('emergency_contact_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <p class="small text-muted">
                        Esta información es importante para que el hospital pueda contactar con alguien de confianza
                        en caso de necesidad.
                    </p>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    Guardar cambios
                </button>
                <a href="{{ route('patient.dashboard') }}" class="btn btn-outline-secondary ms-2">
                    Volver al panel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
