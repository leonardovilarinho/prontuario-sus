@extends('layouts.app')

@section('titulo', 'Informações do hospital')

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
       Aqui você pode editar as informações do hospital, onde os campos em vermelhos são obrigatórios.
    </p>

    <p class="texto-vermelho">
        <strong>Obs:</strong> As alterações podem demorar a serem vistas.
    </p>

    <figure style="text-align:center">
    	<img src="{{ Storage::url('logo.jpg') }}" width="250" alt="Logo de {{ config('prontuario.hospital.nome') }}">
    </figure>

    {!! Form::open(['url' => 'hospital', 'method' => 'post', 'files' => true]) !!}
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {!! Form::label('sistema', 'Sistema') !!}
                {!! Form::text('sistema', config('prontuario.nome') , ['required' => '', 'placeholder' => 'Nome dado ao sistema']) !!}

                {!! Form::label('paginacao', 'Paginação') !!}
                {!! Form::number('paginacao', config('prontuario.paginacao') , ['required' => '', 'placeholder' => 'Itens por página', 'min' => 1, 'max' => 20]) !!}
            </div>

            <div>
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', config('prontuario.hospital.nome') , ['required' => '', 'placeholder' => 'Nome do hospital']) !!}
            </div>

            <div>
                {!! Form::label('local', 'Localização') !!}
                {!! Form::textarea('local', config('prontuario.hospital.local'), ['required' => '', 'placeholder' => 'Localização do hospital', 'row' => 3]) !!}
            </div>

            <div>	
                {!! Form::label('logo', 'Logomarca') !!}
                {!! Form::file('logo', ['accept' => 'image/*']) !!}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar essas informações" class="btn verde">
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