@extends('layouts.app')

@section('titulo', 'Gerenciamento de não-médicos')

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
        Aqui você pode gerenciar qualquer não-médico registrado no sistema, veja a seguir alguns dos quais estão na sua base de dados:
    </p>
    <br>
    <a class="btn verde" href="{{ url('nao-medicos/novo') }}">Cadastrar novo não-médico</a>

    <table>
        <tr>
            <td>Ações</td>
            <td>Nome</td>
            <td>Email</td>
            <td>Especialidade</td>
            <td>CPF</td>
        </tr>

        @foreach($nmedicos as $nmedico)
            <tr>
                <td>
                    <a href="{{ url('usuarios/apagar/' . $nmedico->usuario->id) }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>
                    <a href="{{ url('nao-medicos/editar/' . $nmedico->id) }}" class="btn amarelo">Editar</a>

                    @if($nmedico->usuario->valido)
                        <a href="{{ url('usuarios/bloquear/' . $nmedico->usuario->id) }}" class="btn azul">Bloquear</a>
                    @else
                        <a href="{{ url('usuarios/desbloquear/' . $nmedico->usuario->id) }}" class="btn verde">Desbloquear</a>
                    @endif
                </td>
                <td>{{ $nmedico->usuario->nome }}</td>
                <td>{{ $nmedico->usuario->email }}</td>
                <td>{{ $nmedico->especialidade }}</td>
                <td>{{ $nmedico->usuario->cpf }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $nmedicos->links() }}
    </section>
@endsection