@extends('layouts.app')

@section('title', 'Contacto - Panel Pacientes')

@section('content')
<h1 class="mb-4">Contacto y ubicación</h1>

<div class="row">
    <div class="col-md-6 mb-4">
        <h2>Datos de contacto</h2>
        <p><strong>Teléfono principal:</strong> +34 000 000 000</p>
        <p><strong>Email:</strong> contacto@hospital-ejemplo.com</p>
        <p><strong>Dirección:</strong> Calle Ejemplo 123, Ciudad</p>
        <p><strong>Horario de atención:</strong> Lunes a viernes de 8:00 a 20:00</p>

        <hr>

        <h3>Formulario de contacto (solo diseño)</h3>
        <form>
            <div class="mb-3">
                <label class="form-label">Nombre completo</label>
                <input type="text" class="form-control" placeholder="Tu nombre">
            </div>
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" placeholder="tucorreo@ejemplo.com">
            </div>
            <div class="mb-3">
                <label class="form-label">Mensaje</label>
                <textarea class="form-control" rows="4" placeholder="Escribe tu consulta"></textarea>
            </div>
            <button type="button" class="btn btn-primary" disabled>
                Enviar (pendiente de implementar)
            </button>
        </form>
    </div>

    <div class="col-md-6 mb-4">
        <h2>Ubicación</h2>
        <p>Puedes encontrarnos en la siguiente dirección:</p>
        <div class="ratio ratio-16x9">
            {{-- Sustituye el src por el iframe real de Google Maps cuando lo tengas --}}
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.437904234923!2d-80.63905162608062!3d-5.193644652378522!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x904a1a8162979d7b%3A0x70432d6b57019c86!2sHospital%20Jorge%20Reategui%20Delgado!5e0!3m2!1ses-419!2spe!4v1766853623379!5m2!1ses-419!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            ></iframe>
        </div>
    </div>
</div>
@endsection
