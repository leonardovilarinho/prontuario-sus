@extends('layouts.app')

@section('titulo', 'Minha carga horária')

@section('conteudo')
    <p>
       Olá <span class="texto-verde">{{ auth()->user()->nome }}</span>, aqui você pode editar qual horário você começa e termina o trabalho, assim como a duração média de cada consulta. Assim nós podemos montar os horários para agendamento de suas consultas automaticamente.
    </p>

    <p class="texto-vermelho">
        <strong>Obs:</strong> As alterações só serão feitas para novas consultas.
    </p>


    {!! Form::open(['url' => 'carga', 'method' => 'post', 'files' => true]) !!}
        {{ Form::hidden('medico_id', auth()->user()->id) }}
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {!! Form::label('inicio', 'Início de trabalho (horário)') !!}
                {!! Form::time('inicio', date('H:i', strtotime($carga->inicio)) , ['required' => '', 'placeholder' => 'Horas que você inicia o trabalho']) !!}

                {!! Form::label('fim', 'Fim de trabalho (horário)') !!}
                {!! Form::time('fim', date('H:i', strtotime($carga->fim)), ['required' => '', 'placeholder' => 'Horas que você termina o trabalho']) !!}
            </div>

            <div>
                {!! Form::label('intervalo', 'Duração média de consulta (em minutos)') !!}
                {!! Form::number('intervalo', $carga->intervalo , ['required' => '', 'placeholder' => 'Tempo médio de consulta em minutos']) !!}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar minha carga horária" class="btn verde">
            </section>

            @if($errors->first())
                <span class="texto-vermelho">{{ $errors->first() }}</span>
            @endif
            

            @if(session('msg'))
                <span class="texto-verde">{{ session('msg') }}</span>
            @endif
        </footer>
    {!! Form::close() !!}

@endsection