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
				{{ Form::select('posto', $postos + ['' => 'Nenhum'], ($medico->cabecalho) ? $medico->cabecalho_id : '', ['required' => '']) }}

				{{ Form::submit('Alterar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
			</div>
		</section>
    {{ Form::close() }}

    {{ Form::open(['url' => 'medicos/dia', 'method' => 'get']) }}
		<section>
			<div>
				{{ Form::label('data', 'Data') }}
				{{ Form::date('data',  date('Y-m-d', strtotime($_GET['data'])), ['required' => '']) }}

				{{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
			</div>
		</section>
    {{ Form::close() }}
    <section id="imprimir">
	    <br>

		@if(count($n_atendidas) > 0)
	    	<h3>Aguardando atendimento</h3>
			<ul class="lista-vermelha">
		        @foreach ($n_atendidas as $consulta)
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

		@if(count($atendidas) > 0)
		    <h3>Atendimento finalizado</h3>
			<ul class="lista-verde">
		        @foreach ($atendidas as $consulta)
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


	<button onclick="printDiv('imprimir')" class="btn verde oculta-tel">Imprimir</button>

	<script>
		var ocultos = document.querySelectorAll('.oculto');
		for (var i = 0; i < ocultos.length; i++) {
			ocultos[i].style.display = 'none';
		}
	</script>
@endsection