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


    <p>
        Aqui você pode gerenciar qualquer paciente registrado no sistema, veja a seguir alguns dos quais estão na sua base de dados:
    </p>
    <br>
    <a class="btn verde" href="{{ url('pacientes/novo') }}">Cadastrar novo paciente</a>

    <table>
        <tr>
            <td>Ações</td>
            <td>Nome</td>
            <td>Prontuário</td>
            <td>Sexo</td>
            <td>Naturalidade</td>
            <td>Leito</td>
            <td>Convênio</td>
        </tr>

        @foreach($pacientes as $paciente)
            <tr>
                <td>
                    <a href="{{ url('pacientes/apagar/' . $paciente->id) }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>
                    <a href="{{ url('pacientes/editar/' . $paciente->id) }}" class="btn amarelo">Editar</a>
                </td>
                <td>{{ $paciente->nome }}</td>
                <td>{{ $paciente->prontuario }}</td>
                <td>{{ $paciente->sexo }}</td>
                <td>{{ $paciente->naturalidade }}</td>
                <td>{{ $paciente->leito != null ? $paciente->leito : 'n/d'  }}</td>
                <td>{{ $paciente->convenio }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $pacientes->links() }}
    </section>
@endsection