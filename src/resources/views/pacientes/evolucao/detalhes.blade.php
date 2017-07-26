@extends('layouts.app')

@section('titulo', 'Detalhes de evolução')

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
@endsection

@section('conteudo')

	<a href="{{ url('pacientes/'.$paciente->id.'/evolucoes') }}" class="btn secundaria">Voltar</a>

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
            Evolução
        </header>
        <article>
        	<section>
                <figure style="float:right; margin: 0">
                    <img src="{{ Storage::url('logo.jpg') }}" width="150" alt="Logo de {{ config('prontuario.hospital.nome') }}">
                </figure>
                <h3>{{ config('prontuario.hospital.nome') }}</h3>
                <small>{{ config('prontuario.hospital.local') }}</small>
            </section>

            <hr>
            <p>
            	<strong>Autor: </strong>
            	{{ $evolucao->autor->nome }}
            </p>

            <p>
            	<strong>Paciente: </strong>
            	{{ $evolucao->paciente->nome }}
            </p>

			<hr>
			<p>
				{!! $evolucao->evolucao !!}
			</p>

			<hr>
			<p>
            	<strong>CID: </strong>
            	{{ $evolucao->cid }}
            </p>

            <p>
                {!! $evolucao->diagnostico !!}
            </p>

			<br><br><br>
            <div style="text-align:center" class="oculta-tel">
            	<p>_______________________________________________________________</p>
            	<p>({{ $evolucao->autor->nome }})</p>
            </div>

            <hr>

            <p style="text-align: right;">
            	<small>
            		<strong>Criado em: </strong>
	            	{{ date('d/m/Y á\s H:i', strtotime($evolucao->created_at)) }}
					|
	            	<strong>Última edição: </strong>
	            	{{ date('d/m/Y á\s H:i', strtotime($evolucao->updated_at)) }}
            	</small>
            </p>

        </article>
        <footer style="text-align: right">

			<button onclick="printDiv('imprimir')" class="btn verde oculta-tel">Imprimir</button>

        </footer>
    </section>

@endsection