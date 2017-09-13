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
        Por favor, para iniciar o processo de nova consulta para a(o) médica(o) <span class="texto-verde">{{  $usuario->nome }}</span>, selecione uma data para a consulta a seguir:
    </p>

    {{ Form::open(['url' => 'medicos/'.$usuario->id.'/consulta/horarios', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::date('data', date('Y-m-d'),['required' => '']) }}
                {{ Form::submit('Prosseguir', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

    <hr><hr>
    <h3>
        <span class="texto-verde">{{  $usuario->nome }}</span> trabalha
        @if($medico->dia->segunda)
           <span class="texto-vermelho"> segundas</span>,
        @endif
        @if($medico->dia->terca)
            <span class="texto-vermelho"> terças</span>,
        @endif
        @if($medico->dia->quarta)
            <span class="texto-vermelho"> quartas</span>,
        @endif
        @if($medico->dia->quinta)
            <span class="texto-vermelho"> quintas</span>,
        @endif
        @if($medico->dia->sexta)
            <span class="texto-vermelho"> sextas</span>,
        @endif
        @if($medico->dia->sabado)
            <span class="texto-vermelho"> sábados</span>,
        @endif
        @if($medico->dia->domingo)
            e <span class="texto-vermelho"> domingos</span>.
        @endif
    </h3>

@endsection