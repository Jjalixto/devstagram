@extends('layouts.app')
<!--siempre que tenga @ es una directiva que siempre va a apuntar a views-->
@section('titulo')
    Pagina principal
@endsection

@section('contenido')
    {{-- siempre que veas que una etiqueta empieza con <x- es por que es un componente de laravel --}}
    {{-- asi de por simple significa que el componenete no va soportar slog pero si lo cierras si soportario slogs --}}
    <x-listar-post :posts="$posts"/>
        {{-- <x-slot:titulo>
            <header>
                Esto es un header
            </header>
        </x-slot:titulo>
        <h1>Mostranndo post desdee slog</h1>
    </x-listar-post> --}}

@endsection
