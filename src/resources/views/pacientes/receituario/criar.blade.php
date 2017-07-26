@extends('layouts.app')

@section('titulo', 'Criar um receituário')

@section('conteudo')

    <p>
       Aqui você pode cadastrar um novo receituário para <span class="texto-verde">{{ $paciente->nome }}</span>, preencha os campos vermelhos.
    </p>

    {!! Form::open(['url' => 'pacientes/'.$paciente->id.'/receituarios/novo', 'method' => 'post']) !!}
    	{{ Form::hidden('paciente_id', $paciente->id) }}
    	{{ Form::hidden('autor_id', auth()->user()->id) }}
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {!! Form::label('conteudo', 'Conteúdo') !!}
                {!! Form::textarea('conteudo', '', ['required' => '', 'placeholder' => 'Conteúdo do receituário']) !!}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar essa receituário" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {!! Form::close() !!}


     <script>
        CKEDITOR.config.width = '100%';
        CKEDITOR.replace( 'conteudo' );
    </script>

@endsection