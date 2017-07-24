@extends('layouts.app')

@section('titulo', 'Criar um novo administrador')

@section('conteudo')
    @if($administrador->nome == '')
        <p>
           Aqui você pode cadastrar um novo administrador no sistema, os campos em vermelhos são obrigatórios, então devem ser preenchidos.
        </p>

        <p class="texto-vermelho" style="text-align: right">
            A senha padrão do usuário será o CPF do mesmo.
        </p>
    @else
        <p>
           Aqui você pode editar o registro de '{{ $administrador->nome }}', os campos em vermelhos são obrigatórios, então devem ser preenchidos.
        </p>
    @endif

    @if($administrador->nome == '')
        {!! Form::open(['url' => 'administradores/novo', 'method' => 'post']) !!}
    @else
        {!! Form::open(['url' => 'administradores/editar/'.$administrador->id, 'method' => 'post']) !!}
            {{ Form::hidden('_method', 'put') }}
    @endif
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', $administrador->nome, ['required' => '', 'placeholder' => 'Seu nome completo']) !!}

                {!! Form::label('nascimento', 'Data de nascimento') !!}
                {!! Form::date('nascimento', $administrador->nascimento, ['required' => '']) !!}
            </div>

             <div>
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', $administrador->email, ['required' => '', 'placeholder' => 'Seu endereço de email']) !!}

                {!! Form::label('cpf', 'CPF') !!}
                {!! Form::text('cpf', $administrador->cpf, ['required' => '', 'placeholder' => 'Seu número de CPF', 'maxlength' => 11]) !!}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar esse administrador" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {!! Form::close() !!}

@endsection