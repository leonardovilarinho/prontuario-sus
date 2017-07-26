@extends('layouts.app')

@section('titulo', 'Criar uma nova prescrição')

@section('conteudo')
    <p>
       Aqui você pode criar uma nova prescrição para <span class="texto-verde">{{ $paciente->nome }}</span>
    </p>

    {!! Form::open(['url' => 'pacientes/'.$paciente->id.'/prescricoes/nova', 'method' => 'post']) !!}
        {{ Form::hidden('paciente_id', $paciente->id) }}
    	{{ Form::hidden('autor_id', auth()->user()->id) }}
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', '', ['required' => '', 'placeholder' => 'Dê uma etiqueta para a prescrição']) !!}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Prosseguir" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {!! Form::close() !!}

@endsection