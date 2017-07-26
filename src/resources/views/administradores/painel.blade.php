@extends('layouts.app')

@section('titulo', 'Painel gerencial')

@section('lateral')
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
        Olá <span class="texto-verde">{{ auth()->user()->nome }}</span>, a seguir disponibilizamos algumas contas sobre a quantidade de dados que temos no sistema, veja:
    </p>
    <br>

	<h2>Pessoas</h2>
    <article style="display: flex; flex-direction: row; justify-content: center; flex-wrap: wrap">
    	<section class="cartao">
	        <header>
	            Administradores
	        </header>
	        <article style="text-align: center; padding: 0px; margin: 0px">
	            <h4 style="font-size: 25pt; ">{{ $administradores }}</h4>
	        </article>
	    </section>

	    <section class="cartao">
	        <header>
	            -----Médicos-----
	        </header>
	        <article style="text-align: center; padding: 0px; margin: 0px">
	            <h4 style="font-size: 25pt; ">{{ $medicos }}</h4>
	        </article>
	    </section>

	    <section class="cartao">
	        <header>
	           --Não médicos--
	        </header>
	        <article style="text-align: center; padding: 0px; margin: 0px">
	            <h4 style="font-size: 25pt; ">{{ $nao_medicos }}</h4>
	        </article>
	    </section>

	    <section class="cartao">
	        <header>
	            ---Secretários---
	        </header>
	        <article style="text-align: center; padding: 0px; margin: 0px">
	            <h4 style="font-size: 25pt; ">{{ $secretarios }}</h4>
	        </article>
	    </section>

	    <section class="cartao">
	        <header>
	            ---Pacientes---
	        </header>
	        <article style="text-align: center; padding: 0px; margin: 0px">
	            <h4 style="font-size: 25pt; ">{{ $pacientes }}</h4>
	        </article>
	    </section>
    </article>

    <h2>Papeladas</h2>
    <article style="display: flex; flex-direction: row; justify-content: center; flex-wrap: wrap">
    	<section class="cartao">
	        <header>
	           -Evoluções-
	        </header>
	        <article style="text-align: center; padding: 0px; margin: 0px">
	            <h4 style="font-size: 25pt; ">{{ $evolucoes }}</h4>
	        </article>
	    </section>

	    <section class="cartao">
	        <header>
	            Prescrições
	        </header>
	        <article style="text-align: center; padding: 0px; margin: 0px">
	            <h4 style="font-size: 25pt; ">{{ $prescricoes }}</h4>
	        </article>
	    </section>

	    <section class="cartao">
	        <header>
	           Receituários
	        </header>
	        <article style="text-align: center; padding: 0px; margin: 0px">
	            <h4 style="font-size: 25pt; ">{{ $receituarios }}</h4>
	        </article>
	    </section>
    </article>

    <h2>Hospital</h2>
    <article style="display: flex; flex-direction: row; justify-content: center; flex-wrap: wrap">
    	<section class="cartao">
	        <header>
	           Equipamentos
	        </header>
	        <article style="text-align: center; padding: 0px; margin: 0px">
	            <h4 style="font-size: 25pt; ">{{ $equipamentos }}</h4>
	        </article>
	    </section>

	    <section class="cartao">
	        <header>
	            Medicamentos
	        </header>
	        <article style="text-align: center; padding: 0px; margin: 0px">
	            <h4 style="font-size: 25pt; ">{{ $medicamentos }}</h4>
	        </article>
	    </section>

    </article>


@endsection