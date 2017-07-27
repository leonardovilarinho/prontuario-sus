@extends('layouts.app')

@section('titulo', 'Seu perfil')

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
       Olá <span class="texto-verde">{{ auth()->user()->nome }}</span>, nessa tela você poderá alterar seus dados:
    </p>

    {!! Form::open(['url' => 'perfil', 'method' => 'post']) !!}
    	{{ Form::hidden('_method', 'put') }}
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', auth()->user()->nome, ['required' => '', 'placeholder' => 'Seu nome completo']) !!}

                {!! Form::label('nascimento', 'Data de nascimento') !!}
                {!! Form::date('nascimento', auth()->user()->nascimento, ['required' => '']) !!}
            </div>

            <div>
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email_', auth()->user()->email, ['required' => '', 'placeholder' => 'Seu endereço de email', 'readonly' => '']) !!}

                {!! Form::label('cpf', 'CPF') !!}
                {!! Form::text('cpf_', auth()->user()->cpf, ['required' => '', 'placeholder' => 'Seu número de CPF', 'maxlength' => 11, 'readonly' => '']) !!}
            </div>

			@if(auth()->user()->medico or auth()->user()->nao_medico)
	            <div>
	                {!! Form::label('cargo', 'Cargo') !!}
	                {!! Form::text('cargo', auth()->user()->medico->cargo) !!}

	                {!! Form::label('especialidade', 'Especialidade') !!}
	                {!! Form::text('especialidade', auth()->user()->medico->especialidade) !!}
	            </div>

	            <div>
	                {!! Form::label('conselho', 'Conselho regional') !!}
	                {!! Form::text('conselho', auth()->user()->medico->conselho) !!}

	                {!! Form::label('telefone', 'Telefone') !!}
	                {!! Form::text('telefone', auth()->user()->medico->telefone) !!}
	            </div>
	        @elseif(auth()->user()->secretario)
				<div>
	                {!! Form::label('cargo', 'Cargo') !!}
	                {!! Form::text('cargo', auth()->user()->secretario->cargo) !!}

					{!! Form::label('telefone', 'Telefone') !!}
	                {!! Form::text('telefone', auth()->user()->secretario->telefone) !!}
	            </div>
	        @endif
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar seus dados" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {!! Form::close() !!}

    {!! Form::open(['url' => 'perfil/senha', 'method' => 'post']) !!}
        {{ Form::hidden('_method', 'put') }}
        <header>
            Para altera sua senha:
        </header>

        <section>
            <div>
                {!! Form::label('senha', 'Nova senha') !!}
                {!! Form::password('senha', ['required' => '', 'placeholder' => 'Sua nova senha']) !!}

                {!! Form::label('senha_confirmation', 'Confirmar') !!}
                {!! Form::password('senha_confirmation', ['required' => '', 'placeholder' => 'Sua nova senha']) !!}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Editar sua senha" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {!! Form::close() !!}

@endsection