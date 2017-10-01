@extends('layouts.app')

@section('titulo', 'Suas finanças')

@section('lateral')
@endsection

@section('conteudo')
	<script type="text/javascript">
		function alterarValor(preco, id) {
			var el = document.getElementById('valor');
			el.value = preco.replace(',', '.');

			el = document.getElementById('id');
			el.value = id;

			var oculto = document.getElementById('formval');
			oculto.style.display = '';
		}
	</script>
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

    {{ Form::open(['url' => 'medicos/financas', 'method' => 'get']) }}
		<section>
			<div>
				{{ Form::label('data', 'Data') }}
				{{ Form::date('data',  date('Y-m-d', strtotime($_GET['data'])), ['required' => '']) }}

				{{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
			</div>
		</section>
    {{ Form::close() }}

    {{ Form::open(['url' => 'medicos/financas', 'method' => 'get']) }}
		<section>
			<div>
				{{ Form::label('mes', 'Mês (número)') }}
				{{ Form::number('mes',  $_GET['mes'], ['required' => '', 'max' => 12, 'min' => 1]) }}

				{{ Form::label('ano', 'Ano') }}
				{{ Form::number('ano',  $_GET['ano'], ['required' => '', 'min' => 2000]) }}

				{{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
			</div>
		</section>
    {{ Form::close() }}
    <section id="imprimir">
	    <br>
	    <h3>Total: {{ number_format($preco, 2, ',', '.') }}</h3>

		@if(count($n_atendidas) > 0)
			<ul class="lista-vermelha">
		        @foreach ($n_atendidas as $consulta)
		        	<li>
		        		<span>
		        			{{ date('d/m/Y á\s H:i', strtotime($consulta->horario)) }} -
		        			{{ $consulta->paciente->nome }} |
		        			{{ Saudacoes::idade($consulta->paciente->nascimento) }} ano(s)|
		        			R$ {{ number_format($consulta->valor, 2, ',', '.') }}
		        		</span>

		        		<div class="direita">
			                <a href="{{ url('pacientes/gerenciar/'.$consulta->paciente->id) }}" class="btn azul">Paciente</a>
			                <a onclick="alterarValor('{{ $consulta->valor }}', {{ $consulta->id }})" class="btn amarelo">Trocar valor</a>
			            </div>
		        	</li>
		        @endforeach
		    </ul>
		@endif

		@if(count($atendidas) > 0)
			<ul class="lista-verde">
		        @foreach ($atendidas as $consulta)
		        	<li>
		        		<span>
		        			{{ date('d/m/Y á\s H:i', strtotime($consulta->horario)) }} -
		        			{{ $consulta->paciente->nome }} |
		        			{{ Saudacoes::idade($consulta->paciente->nascimento) }} ano(s) |
		        			R$ {{ number_format($consulta->valor, 2, ',', '.') }}
		        		</span>

		        		<div class="direita">
			                <a href="{{ url('pacientes/gerenciar/'.$consulta->paciente->id) }}" class="btn azul">Paciente</a>
			                <a onclick="alterarValor('{{ $consulta->valor }}', {{ $consulta->id }})" class="btn amarelo">Trocar valor</a>
			            </div>
		        	</li>
		        @endforeach
		    </ul>
		@endif
	</section>

	{{ Form::open(['url' => 'medicos/financas', 'method' => 'get', 'id' => 'formval']) }}
		<section>
			<div>
				{{ Form::label('valor', 'Novo valor da consulta') }}
				{{ Form::number('valor', null,['required' => '', 'step' => 0.1]) }}
				{{ Form::hidden('id', null, ['required' => '', 'id' => 'id']) }}
				{{ Form::hidden('data', date('Y-m-d', strtotime($_GET['data'])), ['required' => '']) }}

				{{ Form::submit('Alterar o valor', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
			</div>
		</section>
    {{ Form::close() }}
    <br>


	<button onclick="printDiv('imprimir')" class="btn verde oculta-tel">Imprimir</button>

	<script>
		var oculto = document.getElementById('formval');
		oculto.style.display = 'none';
	</script>
@endsection