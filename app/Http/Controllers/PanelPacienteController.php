<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelPacienteController extends Controller
{
    public function home()
    {
        return view('panel.home');
    }

    public function servicios()
    {
        // Datos quemados por ahora, luego podrían venir de BD
        $servicios = [
            [
                'nombre' => 'Medicina General',
                'descripcion' => 'Atención primaria y orientación general al paciente.',
                'horario' => 'Lunes a viernes de 08:00 a 18:00',
            ],
            [
                'nombre' => 'Pediatría',
                'descripcion' => 'Cuidado integral de niños y adolescentes.',
                'horario' => 'Lunes a viernes de 09:00 a 17:00',
            ],
            [
                'nombre' => 'Ginecología y Obstetricia',
                'descripcion' => 'Salud reproductiva y control del embarazo.',
                'horario' => 'Lunes a viernes de 10:00 a 18:00',
            ],
        ];

        return view('panel.servicios', compact('servicios'));
    }

    public function faq()
    {
        $preguntas = [
            [
                'pregunta' => '¿Qué seguros médicos aceptan?',
                'respuesta' => 'Actualmente aceptamos Seguro A, Seguro B y Seguro C. Para más detalle, contacte a admisiones.',
            ],
            [
                'pregunta' => '¿Cómo puedo cancelar o cambiar una cita?',
                'respuesta' => 'Puede llamar al teléfono de citas con al menos 24 horas de anticipación o escribir al correo de atención al paciente.',
            ],
            [
                'pregunta' => '¿Atienden urgencias 24 horas?',
                'respuesta' => 'Sí, el servicio de urgencias está disponible las 24 horas, los 365 días del año.',
            ],
        ];

        return view('panel.faq', compact('preguntas'));
    }

    public function contacto()
    {
        // Estos datos podrías pasarlos también desde aquí si quieres
        return view('panel.contacto');
    }
}
