@extends('layouts.app')

@section('titulo', 'Gerenciar administrador')

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
@endsection

@section('conteudo')

	<a href="{{ url('administradores') }}" class="btn secundaria">Voltar</a>

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

    <section class="cartao" id="imprimir">
        <header>
            {{ $administrador->usuario->nome }}
        </header>
        <article>
            <p>
            	<strong>Email: </strong>
            	{{ $administrador->usuario->email }}
            </p>

            <p>
            	<strong>CPF: </strong>
            	{{ $administrador->usuario->cpf }}
            </p>

            <p>
            	<strong>Nascimento: </strong>
            	{{ date('d/m/Y', strtotime($administrador->usuario->nascimento)) }}
            </p>

            <p>
            	<strong>Status: </strong>
            	{{ ($administrador->usuario->valido) ? 'Ativo' : 'Inativo' }}
            </p>

            <hr>

            <p style="text-align: right;">
            	<small>
            		<strong>Criado em: </strong>
	            	{{ date('d/m/Y á\s H:i', strtotime($administrador->usuario->created_at)) }}
					|
	            	<strong>Última edição: </strong>
	            	{{ date('d/m/Y á\s H:i', strtotime($administrador->usuario->updated_at)) }}
            	</small>
            </p>

        </article>
        <footer style="text-align: right">
            <a href="{{ url('usuarios/apagar/' . $administrador->usuario->id) }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>

            <a href="{{ url('administradores/editar/' . $administrador->usuario->id) }}" class="btn amarelo">Editar</a>

            @if($administrador->usuario->valido)
                <a href="{{ url('usuarios/bloquear/' . $administrador->usuario->id) }}" class="btn azul">Bloquear</a>
            @else
                <a href="{{ url('usuarios/desbloquear/' . $administrador->usuario->id) }}" class="btn azul">Desbloquear</a>
            @endif

            <a href="{{ url('usuarios/redefinir/' . $administrador->usuario->id) }}" class="btn verde">Redefinir senha</a>

            <button onclick="printDiv('imprimir')" class="btn verde oculta-tel">Imprimir</button>
        </footer>
    </section>

@endsection