@extends('layouts.app')

@section('titulo', 'Gerenciar posto')

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
@endsection

@section('conteudo')

	<a href="{{ url('postos') }}" class="btn secundaria">Voltar</a>

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
            {{ $posto->nome }}
        </header>
        <article>

            <figure style="text-align:center">
                <img src="{{ Storage::url('postos/'.$posto->id.'.jpg') }}" width="250" alt="Logo de {{ $posto->local }}">
            </figure>

            <p>
            	<strong>Local: </strong>
            	{{ $posto->local }}
            </p>

        </article>
        <footer style="text-align: right">

            @if(auth()->user()->administrador)
                <a href="{{ url('postos/apagar/' . $posto->id) }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>

                <a href="{{ url('postos/editar/' . $posto->id) }}" class="btn amarelo">Editar</a>
            @endif
        	 


            <button onclick="printDiv('imprimir')" class="btn verde oculta-tel">Imprimir</button>
        </footer>
    </section>

@endsection