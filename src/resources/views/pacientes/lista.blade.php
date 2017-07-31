@extends('layouts.app')

@section('titulo', 'Gerenciamento de pacientes')

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

    {{ Form::open(['url' => 'pacientes', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por nome, email, CPF, prontuario ou nascimento']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

    <p>
        Aqui você pode gerenciar qualquer paciente registrado no sistema, veja a seguir alguns dos quais estão na sua base de dados:
    </p>
    <br>

    @if(auth()->user()->secretario)
        <a class="btn verde" href="{{ url('pacientes/novo') }}">Cadastrar novo paciente</a>
    @endif

    <table>
        <tr>
            <td>Ações</td>
            <td>Nome</td>
            <td>Prontuário</td>
            <td>Sexo</td>
            <td>Idade</td>
            <td>Leito</td>
            <td>Convênio</td>
            <td>Nascimento</td>
        </tr>

        @foreach($pacientes as $paciente)
            <tr>
                <td>
                    <a href="{{ url('pacientes/gerenciar/' . $paciente->id) }}" class="btn azul">Gerenciar</a>
                </td>
                <td>{{ $paciente->nome }}</td>
                <td>{{ $paciente->prontuario }}</td>
                <td>{{ $paciente->sexo }}</td>
                <td>{{ Saudacoes::idade($paciente->nascimento) }} ano(s)</td>
                <td>{{ $paciente->leito != null ? $paciente->leito : 'n/d'  }}</td>
                <td>{{ $paciente->convenio }}</td>
                <td>{{ date('d/m/Y', strtotime($paciente->nascimento)) }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $pacientes->links() }}
    </section>
@endsection