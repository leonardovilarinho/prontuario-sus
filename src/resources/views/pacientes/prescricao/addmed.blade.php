@extends('layouts.app')

@section('titulo', 'Adicionar um medicamento')

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
		Por favor, selecione um medicamento e preencha os campos do formulário para adiciona-lo a prescrição atual.
	</p>
	<br>
    <p><strong>Prescrição:</strong> {{ $prescricao->nome }}</p>
    <p><strong>Paciente:</strong> {{ $paciente->nome }}</p>

    {{ Form::open(['url' => 'pacientes/'.$paciente->id.'/prescricoes/'.$prescricao->id.'/addmed', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por nome do medicamento']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

    {{ Form::open(['url' => 'pacientes/'.$paciente->id.'/prescricoes/'.$prescricao->id.'/addmed', 'method' => 'post']) }}
    	{{ Form::hidden('prescricao_id', $prescricao->id) }}
    	<header>
    		Por favor, preencha os dados:
    	</header>

    	<section>
    		<label for="medicacao_id">Medicamento:</label>
			<ul class="lista-comum">
		        @foreach ($medicamentos as $medicamento)
		        	<li>
		        		<span>
		        			{{ $medicamento->nome }}
		        		</span>

		        		<div class="direita">
			                <input style="height: 20px; width: 20px" type="radio" name="medicacao_id" value="{{ $medicamento->id }}" required>
			            </div>
		        	</li>
		        @endforeach
		    </ul>
    		<div>
				{!! Form::label('dose', 'Dose') !!}
                {!! Form::text('dose', '', ['required' => '', 'placeholder' => 'Dose do medicamento']) !!}
    		</div>
    		<div>
    			{!! Form::label('intervalo', 'Intervalo (horas)') !!}
                {!! Form::number('intervalo', '', ['required' => '', 'placeholder' => 'Intervalo para dose', 'min' => 1]) !!}

                {!! Form::label('tempo', 'T. Uso (dias)') !!}
                {!! Form::number('tempo', '', ['required' => '', 'placeholder' => 'Tempo de uso', 'min' => 1]) !!}
    		</div>
    	</section>

    	<footer>
    		<section>
                <input type="submit" value="Salvar esse medicamento" class="btn verde">
            </section>

            @if($errors->first())
                <span class="texto-vermelho">{{ $errors->first() }}</span>
            @endif
    	</footer>
	{{ Form::close() }}

    <section style="text-align:center">
        {{ $medicamentos->links() }}
    </section>

@endsection