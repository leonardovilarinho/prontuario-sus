@extends('layouts.app')

@section('titulo', 'Secreátios do médico')

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
        Aqui você pode gerenciar os secretários para {{ $usuario->nome }}
    </p>
    <br>
    <section class="cartao">
    	{{ Form::open(['url' => 'usuarios/secretarios/'.$usuario->id, 'method' => 'post']) }}
	    	<header>Secretários</header>
	        <section>
	            @foreach($secretarios as $sec)
	            	<div>
	            		<div class="marcador">
		                    <input type="checkbox" id="u{{ $sec->usuario->id }}" name="sec[]"
		                    value="{{ $sec->usuario->id }}" {{ in_array($sec->usuario->id, $inc) ? 'checked' : '' }} />
		                    <label for="u{{ $sec->usuario->id }}">Toggle</label>
		                </div>
		                <label>{{ $sec->usuario->nome }}</label>
		            </div>
	            @endforeach
	        </section>
	        <footer style="text-align: right">
	        	<button class="btn verde">Salvar secretários</button>
	        </footer>
	    {{ Form::close() }}
    </section>
@endsection