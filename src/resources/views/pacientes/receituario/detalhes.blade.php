@extends('layouts.app')

@section('titulo', 'Detalhes de  receita')

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
@endsection

@section('conteudo')

	<a href="{{ url('pacientes/'.$paciente->id.'/receituarios') }}" class="btn secundaria">Voltar</a>

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
            Receituário
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
            	{{ $receita->autor->nome }}
            </p>

            <p>
            	<strong>Paciente: </strong>
            	{{ $receita->paciente->nome }}
            </p>

            <hr>

            <p>
            	{{ $receita->conteudo }}
            </p>

			<br><br><br>
            <div style="text-align:center">
            	<p>_______________________________________________________________</p>
            	<p>({{ $receita->autor->nome }})</p>
            </div>

            <hr>

            <p style="text-align: right;">
            	<small>
            		<strong>Criado em: </strong>
	            	{{ date('d/m/Y á\s H:i', strtotime($receita->created_at)) }}
					|
	            	<strong>Última edição: </strong>
	            	{{ date('d/m/Y á\s H:i', strtotime($receita->updated_at)) }}
            	</small>
            </p>

        </article>
        <footer style="text-align: right">

			<button onclick="printDiv('imprimir')" class="btn verde">Imprimir</button>

        </footer>
    </section>

@endsection