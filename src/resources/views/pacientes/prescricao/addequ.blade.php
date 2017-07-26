@extends('layouts.app')

@section('titulo', 'Adicionar um equipamento')

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
		Por favor, selecione um equipamento e preencha os campos do formulário para adiciona-lo a prescrição atual.
	</p>
	<br>
    <p><strong>Prescrição:</strong> {{ $prescricao->nome }}</p>
    <p><strong>Paciente:</strong> {{ $paciente->nome }}</p>

    {{ Form::open(['url' => 'pacientes/'.$paciente->id.'/prescricoes/'.$prescricao->id.'/addequ', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por nome do equipamento']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

    {{ Form::open(['url' => 'pacientes/'.$paciente->id.'/prescricoes/'.$prescricao->id.'/addequ', 'method' => 'post']) }}
    	{{ Form::hidden('prescricao_id', $prescricao->id) }}
    	<header>
    		Por favor, preencha os dados:
    	</header>

    	<section>
    		<label for="equipamento_id">Equipamento:</label>
			<ul class="lista-comum">
		        @foreach ($equipamentos as $equipamento)
		        	<li>
		        		<span>
		        			{{ $equipamento->nome }}
		        		</span>

		        		<div class="direita">
			                <input style="height: 20px; width: 20px" type="radio" name="equipamento_id" value="{{ $equipamento->id }}" required>
			            </div>
		        	</li>
		        @endforeach
		    </ul>
    	</section>

    	<footer>
    		<section>
                <input type="submit" value="Salvar esse equipamento" class="btn verde">
            </section>

            @if($errors->first())
                <span class="texto-vermelho">{{ $errors->first() }}</span>
            @endif
    	</footer>
	{{ Form::close() }}

    <section style="text-align:center">
        {{ $equipamentos->links() }}
    </section>

@endsection