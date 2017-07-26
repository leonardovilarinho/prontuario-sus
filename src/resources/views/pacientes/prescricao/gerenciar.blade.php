@extends('layouts.app')

@section('titulo', 'Gerenciar prescrição')

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
@endsection

@section('conteudo')

	<a href="{{ url('pacientes/'.$paciente->id.'/prescricoes') }}" class="btn secundaria">Voltar</a>

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
            {{ $prescricao->nome }}
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
                {{ $prescricao->autor->nome }}
            </p>

            <p>
            	<strong>Paciente: </strong>
            	{{ $paciente->nome }}
            </p>

			<label><strong>Medicamentos:</strong></label>
            <ul class="lista-comum">
		        @foreach ($prescricao->medicamentos as $medicamento)
		        	<li>
		        		<span>
		        			{{ $medicamento->nome }}
		        			( {{ $medicamento->pivot->dose }} ) - 
		        			por {{ $medicamento->pivot->tempo }} dias, de
		        			{{ $medicamento->pivot->intervalo }} em {{ $medicamento->pivot->intervalo }} horas
		        		</span>
		        		<div class="direita">
			                <a href="{{ url('pacientes/'.$paciente->id.'/prescricoes/'.$prescricao->id.'/remmed/'.$medicamento->pivot->id) }}" class="btn verde">Apagar</a>
			            </div>
		        	</li>
		        @endforeach
		    </ul>

		    <label><strong>Equipamentos:</strong></label>
            <ul class="lista-azul">
		        @foreach ($prescricao->equipamentos as $equipamento)
		        	<li>
		        		<span>
		        			{{ $equipamento->nome }}
		        		</span>

		        		<div class="direita">
			                <a href="{{ url('pacientes/'.$paciente->id.'/prescricoes/'.$prescricao->id.'/remequ/'.$equipamento->pivot->id) }}" class="btn verde">Apagar</a>
			            </div>
		        	</li>
		        @endforeach
		    </ul>

            <br><br><br>
            <div style="text-align:center" class="oculta-tel">
                <p>_______________________________________________________________</p>
                <p>({{ $prescricao->autor->nome }})</p>
            </div>

            <hr>

            <p style="text-align: right;">
            	<small>
            		<strong>Criado em: </strong>
	            	{{ date('d/m/Y á\s H:i', strtotime($prescricao->created_at)) }}
					|
	            	<strong>Última edição: </strong>
	            	{{ date('d/m/Y á\s H:i', strtotime($prescricao->updated_at)) }}
            	</small>
            </p>

        </article>
        <footer style="text-align: right">
            @if(!auth()->user()->administrador)
                <a href="{{ url('pacientes/' . $paciente->id.'/prescricoes/'.$prescricao->id.'/addmed') }}"
                class="btn azul">Add Medicamento</a>

                <a href="{{ url('pacientes/' . $paciente->id.'/prescricoes/'.$prescricao->id.'/addequ') }}"
                class="btn amarelo">Add Equipamento</a>
            @endif
            <button onclick="printDiv('imprimir')" class="btn verde  oculta-tel">Imprimir</button>
        </footer>
    </section>

@endsection