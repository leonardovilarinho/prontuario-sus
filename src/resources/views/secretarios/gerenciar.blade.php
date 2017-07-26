@extends('layouts.app')

@section('titulo', 'Gerenciar secretário')

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
@endsection

@section('conteudo')

	<a href="{{ url('secretarios') }}" class="btn secundaria">Voltar</a>

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
            {{ $secretario->usuario->nome }}
        </header>
        <article>
            <p>
            	<strong>Email: </strong>
            	{{ $secretario->usuario->email }}
            </p>

            <p>
            	<strong>CPF: </strong>
            	{{ $secretario->usuario->cpf }}
            </p>

            <p>
            	<strong>Nascimento: </strong>
            	{{ date('d/m/Y', strtotime($secretario->usuario->nascimento)) }}
            </p>

            <p>
            	<strong>Status: </strong>
            	{{ ($secretario->usuario->valido) ? 'Ativo' : 'Inativo' }}
            </p>

            <p>
            	<strong>Cargo: </strong>
            	{{ $secretario->cargo }}
            </p>

            <p>
            	<strong>Telefone: </strong>
            	{{ $secretario->telefone }}
            </p>

            <hr>

            <p style="text-align: right;">
            	<small>
            		<strong>Criado em: </strong>
	            	{{ date('d/m/Y á\s H:i', strtotime($secretario->usuario->created_at)) }}
					|
	            	<strong>Última edição: </strong>
	            	{{ date('d/m/Y á\s H:i', strtotime($secretario->usuario->updated_at)) }}
            	</small>
            </p>

        </article>
        <footer style="text-align: right">

        	 <a href="{{ url('usuarios/apagar/' . $secretario->usuario->id) }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>
            <a href="{{ url('secretarios/editar/' . $secretario->id) }}" class="btn amarelo">Editar</a>

            @if($secretario->usuario->valido)
                <a href="{{ url('usuarios/bloquear/' . $secretario->usuario->id) }}" class="btn azul">Bloquear</a>
            @else
                <a href="{{ url('usuarios/desbloquear/' . $secretario->usuario->id) }}" class="btn azul">Desbloquear</a>
            @endif

            <a href="{{ url('usuarios/redefinir/' . $secretario->usuario->id) }}" class="btn verde">Redefinir senha</a>

            <button onclick="printDiv('imprimir')" class="btn verde">Imprimir</button>
        </footer>
    </section>

@endsection