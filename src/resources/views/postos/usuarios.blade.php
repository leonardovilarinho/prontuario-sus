@extends('layouts.app')

@section('titulo', 'Usuários do posto')

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
        Aqui você pode gerenciar os funcionários que poderão estar no posto {{ $posto->nome }}
    </p>
    <br>
    <section class="cartao">
    	{{ Form::open(['url' => 'postos/usuarios/'.$posto->id, 'method' => 'post']) }}
	    	<header>Usuários</header>
	        <section>
	            @foreach($usuarios as $usuario)
	            	<div>
	            		<div class="marcador">
		                    <input type="checkbox" id="u{{ $usuario->id }}" name="usuarios[]"
		                    value="{{ $usuario->id }}" {{ in_array($usuario->id, $uposto) ? 'checked' : '' }} />
		                    <label for="u{{ $usuario->id }}">Toggle</label>
		                </div>
		                <label>{{ $usuario->nome }}</label>
		            </div>
	            @endforeach
	        </section>
	        <footer style="text-align: right">
	        	<button class="btn verde">Salvar funcionários</button>
	        </footer>
	    {{ Form::close() }}
    </section>
@endsection