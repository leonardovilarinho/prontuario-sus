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

            <figure style="text-align:center; height: 200px">
                <img style="text-align:center; height: 200px;" src="{{ Storage::url('postos/'.$posto->id.'.jpg') }}" alt="Logo de {{ $posto->local }}">
            </figure>

            <p>
            	<strong>Slogan: </strong>
            	{{ $posto->local }}
            </p>
            <p>
            	<strong>Endereço: </strong>
            	{{ $posto->endereco }}
            </p>
            <p>
            	<strong>Telefone: </strong>
            	{{ $posto->telefone }}
            </p>

        </article>
        <footer style="text-align: right">

            @if(auth()->user()->administrador)
                @if($posto->atendida)
                    <a href="{{ url('postos/desativar/' . $posto->id) }}" onclick="return confirm('Deseja desativar?')" class="btn vermelho">Desativar</a>
                @else
                    <a href="{{ url('postos/ativar/' . $posto->id) }}" onclick="return confirm('Deseja ativar?')" class="btn vermelho">Ativar</a>
                @endif

                <a href="{{ url('postos/editar/' . $posto->id) }}" class="btn amarelo">Editar</a>
                <a href="{{ url('postos/usuarios/' . $posto->id) }}" class="btn azul">Funcionários</a>
            @endif


            <button onclick="printDiv('imprimir')" class="btn verde oculta-tel">Imprimir</button>
        </footer>
    </section>

@endsection