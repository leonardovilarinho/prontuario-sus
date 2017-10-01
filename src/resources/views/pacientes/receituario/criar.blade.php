@extends('layouts.app')

@section('titulo', 'Criar um receituário')

@section('conteudo')

    <p>
       Aqui você pode cadastrar um novo receituário para <span class="texto-verde">{{ $paciente->nome }}</span>, preencha os campos vermelhos.
    </p>
    <ul>
        <li><strong>Nascimento:</strong>{{ date('d/m/Y', strtotime($paciente->nascimento)) }}</li>
        <li><strong>Idade:</strong>{{ Saudacoes::idade($paciente->nascimento) }}</li>
        <li><strong>Convênio:</strong>{{ $paciente->convenio }}</li>
    </ul>

    {{ Form::open(['url' => '#', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::label('modelo', 'Modelo') }}
                {{ Form::select('modelo', $modelos, '',
                    ['required' => '']
                ) }}
                <button class="btn verde" style='flex-grow: 1; margin-left: 3px'>
                    Selecionar
                </button>

            </div>
        </section>
    {{ Form::close() }}

    {!! Form::open(['url' => 'pacientes/'.$paciente->id.'/receituarios/novo', 'method' => 'post']) !!}
    	{{ Form::hidden('paciente_id', $paciente->id) }}
    	{{ Form::hidden('autor_id', auth()->user()->id) }}
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {!! Form::label('conteudo', 'Conteúdo') !!}
                {!! Form::textarea('conteudo', $valor, ['required' => '', 'placeholder' => 'Conteúdo do receituário']) !!}
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