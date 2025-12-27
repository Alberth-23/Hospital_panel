@extends('layouts.app')

@section('title', 'Preguntas frecuentes - Panel Pacientes')

@section('content')
<h1 class="mb-4">Preguntas frecuentes</h1>

<p class="mb-3">
    Aquí respondemos algunas de las dudas más habituales de nuestros pacientes.
    Si no encuentras respuesta a tu pregunta, puedes contactarnos directamente.
</p>

<div class="accordion" id="faqAccordion">
    @foreach ($preguntas as $index => $item)
        @php
            $headingId = 'heading' . $index;
            $collapseId = 'collapse' . $index;
            $show = $index === 0 ? 'show' : '';
            $collapsed = $index === 0 ? '' : 'collapsed';
        @endphp

        <div class="accordion-item">
            <h2 class="accordion-header" id="{{ $headingId }}">
                <button class="accordion-button {{ $collapsed }}" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#{{ $collapseId }}">
                    {{ $item['pregunta'] }}
                </button>
            </h2>
            <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $show }}"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {{ $item['respuesta'] }}
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
