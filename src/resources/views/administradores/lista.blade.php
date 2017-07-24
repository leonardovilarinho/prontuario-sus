@extends('layouts.app')

@section('titulo', 'Gerenciamento de administradores')

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
        Aqui você pode gerenciar qualquer administrador registrado no sistema, veja a seguir alguns dos quais estão na sua base de dados:
    </p>
    <br>
    <a class="btn verde" href="{{ url('administradores/novo') }}">Cadastrar novo administrador</a>

    <table>
        <tr>
            <td>Ações</td>
            <td>Nome</td>
            <td>Email</td>
            <td>Nascimento</td>
            <td>CPF</td>
        </tr>

        @foreach($administradores as $administrador)
            <tr>
                <td>
                    @if($administrador->usuario->id != 1 and auth()->user()->administrador->usuario_id == 1)
                    	<a href="{{ url('usuarios/apagar/' . $administrador->usuario->id) }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>

	                    <a href="{{ url('administradores/editar/' . $administrador->usuario->id) }}" class="btn amarelo">Editar</a>

	                    @if($administrador->usuario->valido)
	                        <a href="{{ url('usuarios/bloquear/' . $administrador->usuario->id) }}" class="btn azul">Bloquear</a>
	                    @else
	                        <a href="{{ url('usuarios/desbloquear/' . $administrador->usuario->id) }}" class="btn verde">Desbloquear</a>
	                    @endif
	                @else
	                	<span class="texto-vermelho">Indisponível</span>
	                @endif
                </td>
                <td>{{ $administrador->usuario->nome }}</td>
                <td>{{ $administrador->usuario->email }}</td>
                <td>{{ date('d/m/Y', strtotime($administrador->usuario->nascimento)) }}</td>
                <td>{{ $administrador->usuario->cpf }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $administradores->links() }}
    </section>
@endsection