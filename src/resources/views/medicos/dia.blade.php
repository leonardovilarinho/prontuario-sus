@extends('layouts.app')

@section('titulo', 'Consultas do dia')

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

    {{ Form::open(['url' => 'medicos/dia', 'method' => 'get']) }}
		<section>
			<div>
				{{ Form::label('dias', 'Dias a frente') }}
				{{ Form::number('dias', (isset($_GET['dias']) ? $_GET['dias'] : 0), ['required' => '', 'min' => 0]) }}

				{{ Form::submit('Buscar', ['class' => 'btn verde']) }}
			</div>
		</section>
    {{ Form::close() }}


    <section id="imprimir">
    	<p>
	        Olá <span class="texto-verde">{{ auth()->user()->nome }}</span>, aqui estão suas consultas de hoje:
	    </p>
	    <br>
		@if(count($andamento) > 0)
			<h2>Consultas em andamento</h2>
			<ul class="lista-amarela">
		        @foreach ($andamento as $consulta)
		        	<li>
		        		<span>
		        			{{ date('d/m/Y á\s H:i', strtotime($consulta->horario)) }} -
		        			{{ $consulta->paciente->nome }}
		        		</span>

		        		<div class="direita">
			                <a href="{{ url('pacientes/gerenciar/'.$consulta->paciente->id) }}" class="btn azul">Paciente</a>
			            </div>
		        	</li>
		        @endforeach
		    </ul>
		@endif

		@if(count($futuras) > 0)
	    	<h2>Aguardando atendimento</h2>
			<ul class="lista-vermelha">
		        @foreach ($futuras as $consulta)
		        	<li>
		        		<span>
		        			{{ date('d/m/Y á\s H:i', strtotime($consulta->horario)) }} -
		        			{{ $consulta->paciente->nome }}
		        		</span>

		        		<div class="direita">
			                <a href="{{ url('pacientes/gerenciar/'.$consulta->paciente->id) }}" class="btn azul">Paciente</a>
			            </div>
		        	</li>
		        @endforeach
		    </ul>
		@endif

		@if(count($passadas) > 0)
		    <h2>Atendimento finalizado</h2>
			<ul class="lista-verde">
		        @foreach ($passadas as $consulta)
		        	<li>
		        		<span>
		        			{{ date('d/m/Y á\s H:i', strtotime($consulta->horario)) }} -
		        			{{ $consulta->paciente->nome }}
		        		</span>

		        		<div class="direita">
			                <a href="{{ url('pacientes/gerenciar/'.$consulta->paciente->id) }}" class="btn azul">Paciente</a>
			            </div>
		        	</li>
		        @endforeach
		    </ul>
		@endif
	</section>

	<button onclick="printDiv('imprimir')" class="btn verde oculta-tel">Imprimir</button>
@endsection