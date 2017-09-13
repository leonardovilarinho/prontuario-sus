@extends('layouts.app')

@section('titulo', 'Painel gerencial')

@section('lateral')
@endsection

@section('conteudo')

    <p style="text-align:center">
        @if(session('msg'))
            <span class="texto-verde">
                {{ session('msg') }}
            </span>
        @endif

         @if(session('erro'))
            <span class="texto-vermelho">
                {{ session('erro') }}
            </span>
        @endif
    </p>


    <p>
        Olá <span class="texto-verde">{{ auth()->user()->nome }}</span>!
    </p>
@endsection