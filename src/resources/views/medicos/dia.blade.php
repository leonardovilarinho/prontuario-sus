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

    {{ Form::open(['url' => 'medicos/lugar', 'method' => 'post']) }}
		<section>
			<div>
				<span style="font-size: 18pt; margin-right: 5px">Hoje você está no: </span>
				{{ Form::select('posto', $postos + ['' => 'Nenhum'], (auth()->user()->medico->cabecalho) ? auth()->user()->medico->cabecalho_id : '', ['required' => '']) }}

				{{ Form::submit('Alterar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
			</div>
		</section>
    {{ Form::close() }}

    {{ Form::open(['url' => 'medicos/dia', 'method' => 'get']) }}
		<section>
			<div>
				{{ Form::label('dias', 'Dias') }}
				{{ Form::number('dias', (isset($_GET['dias']) ? $_GET['dias'] : 1), ['required' => '', 'min' => 1]) }}

				{{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
			</div>
		</section>
    {{ Form::close() }}

    <section id="imprimir">
    	<p>
	        Olá <span class="texto-verde">{{ auth()->user()->nome }}</span>, aqui estão suas consultas entre <span class="texto-verde">{{ $inicio->format('d/m/Y á\s H:i') }}</span> e <span class="texto-verde">{{ $fim->format('d/m/Y á\s H:i') }}</span:
	    </p>
	    <br>

		@if(count($futuras) > 0)
	    	<h3>Aguardando atendimento</h3>
			<ul class="lista-vermelha">
		        @foreach ($futuras as $consulta)
		        	<li>
		        		<span>
		        			{{ date('d/m/Y á\s H:i', strtotime($consulta->horario)) }} -
		        			{{ $consulta->paciente->nome }} |
		        			{{ Saudacoes::idade($consulta->paciente->nascimento) }} ano(s)
		        		</span>

		        		<div class="direita">
			                <a href="{{ url('pacientes/gerenciar/'.$consulta->paciente->id) }}" class="btn azul">Paciente</a>
			                <a href="{{ url('medicos/consulta/'.$consulta->id.'/atender') }}" class="btn verde">Finalizar</a>
			            </div>
		        	</li>
		        @endforeach
		    </ul>
		@endif

		@if(count($passadas) > 0)
		    <h3>Atendimento finalizado</h3>
			<ul class="lista-verde">
		        @foreach ($passadas as $consulta)
		        	<li>
		        		<span>
		        			{{ date('d/m/Y á\s H:i', strtotime($consulta->horario)) }} -
		        			{{ $consulta->paciente->nome }} |
		        			{{ Saudacoes::idade($consulta->paciente->nascimento) }} ano(s)
		        		</span>

		        		<div class="direita">
			                <a href="{{ url('pacientes/gerenciar/'.$consulta->paciente->id) }}" class="btn azul">Paciente</a>
			            </div>
		        	</li>
		        @endforeach
		    </ul>
		@endif
	</section>

	<button class="btn vermelho" disabled>Total de {{ $preco }} reais!</button>

	<button onclick="printDiv('imprimir')" class="btn verde oculta-tel">Imprimir</button>
@endsection