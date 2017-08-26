@extends('layouts.app')

@section('titulo', 'Selecionar data para consulta')

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
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
        Por favor, para iniciar o processo de nova consulta para a(o) médica(o) <span class="texto-verde">{{  $medico->nome }}</span>, selecione uma data para a consulta a seguir:
    </p>

    {{ Form::open(['url' => 'medicos/'.$medico->id.'/consulta/horarios', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::date('data', date('Y-m-d'),['required' => '']) }}
                {{ Form::submit('Prosseguir', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

@endsection