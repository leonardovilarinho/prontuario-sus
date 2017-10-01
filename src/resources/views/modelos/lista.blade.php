@extends('layouts.app')

@section('titulo', 'Seus modelos')

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

    {{ Form::open(['url' => 'modelos/manipular', 'method' => 'post']) }}
		<section>
			<div>
				{{ Form::label('modelo', 'Modelo') }}
				{{ Form::select('modelo', $select, $modelo->id,
                    ['required' => '']
                ) }}

                <input type="submit" name="acao" value="Apagar" class="btn vermelho" style='flex-grow: 1; margin-left: 3px' onclick="return confirm('Deseja realmente apagar?')">
                <input type="submit" name="acao" value="Editar" class="btn amarelo" style='flex-grow: 1; margin-left: 3px'>

			</div>
		</section>
    {{ Form::close() }}

    {{ Form::open(['url' => 'modelos', 'method' => 'post']) }}
    	<header>
            @if($modelo->id != null)
            	Editar modelo
            @else
            	Novo modelo
            @endif
        </header>

        <section>

        	@if($modelo->id != null)
            	<input type="hidden" name="tipo" value="editar">
            	<input type="hidden" name="modelo" value="{{ $modelo->id }}">
            @else
            	<input type="hidden" name="tipo" value="novo">
            @endif
  
            <div>
                {{ Form::label('titulo', 'Título (Apelido)') }}
				{{ Form::text('titulo',  $modelo->titulo, ['required' => '']) }}
            </div>

            <div>
                {{ Form::label('conteudo', 'Conteúdo') }}
				{!! Form::textarea('conteudo', $modelo->conteudo, ['required' => '', 'placeholder' => 'Digite seu modelo']  ) !!}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar esse modelo" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {{ Form::close() }}
 
 	 <script>
        CKEDITOR.config.width = '100%';
        CKEDITOR.replace( 'conteudo' );
    </script>
@endsection