@extends('layouts.app')

@section('titulo', 'Selecionar o paciente')

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
        Por favor, para continuar o processo de nova consulta para a(o) médica(o) <span class="texto-verde">{{  $medico->usuario->nome }}</span>, selecione um paciente para a consulta a seguir:
    </p>
    <br>

    <p><strong>Médica(o):</strong> {{ $medico->usuario->nome }}</p>
    <p><strong>Horário definido:</strong> {{ date('d/m/Y á\s H:i', strtotime($_GET['horario'])) }}</p>

    {{ Form::open(['url' => 'medicos/'.$medico->usuario_id.'/consulta/marcar', 'method' => 'get']) }}
    	{{ Form::hidden('horario', $_GET['horario']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por nome, email, CPF, prontuario ou nascimento']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}


	<table>
        <tr>
            <td>Ações</td>
            <td>Nome</td>
            <td>Prontuário</td>
            <td>Sexo</td>
            <td>Nascimento</td>
            <td>Leito</td>
            <td>Convênio</td>
        </tr>

        @foreach($pacientes as $paciente)
            <tr>
                <td>
					{{ Form::open([
						'url' => 'medicos/'.$medico->usuario_id.'/consulta/finalizar',
						'method' => 'get', 'class' => 'no-style'
					]) }}

                        {{ Form::hidden('paciente', $paciente->id) }}
                        {{ Form::hidden('horario', $_GET['horario']) }}

						<button class="btn verde">
							Selecionar
						</button>
					{{ Form::close() }}
                </td>
                <td>{{ $paciente->nome }}</td>
                <td>{{ $paciente->prontuario }}</td>
                <td>{{ $paciente->sexo }}</td>
                <td>{{ date('d/m/Y', strtotime($paciente->nascimento)) }}</td>
                <td>{{ $paciente->leito != null ? $paciente->leito : 'n/d'  }}</td>
                <td>{{ $paciente->convenio }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $pacientes->links() }}
    </section>

@endsection