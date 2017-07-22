@extends('layouts.app')

@section('titulo', 'Primeiro acesso ao sistema')

@section('lateral')
    <li><a href="#">Primeiro acesso</a></li>
@endsection

@section('conteudo')
    <p>
        Olá, você acabou de instalar nosso sistema, para começar a usar precisamos que realize o cadastro do primeiro administrador.
        Esse administrador será considerado um super administrador, tendo permissão para gerenciar outros administradores do sistema.
    </p>

    {!! Form::open(['url' => 'administradores/primeiro', 'method' => 'post']) !!}
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', '', ['required' => '', 'placeholder' => 'Seu nome completo']) !!}
            </div>

             <div>
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', '', ['required' => '', 'placeholder' => 'Seu endereço de email']) !!}

                {!! Form::label('cpf', 'CPF') !!}
                {!! Form::text('cpf', '', ['required' => '', 'placeholder' => 'Seu número de CPF', 'maxlength' => 11]) !!}
            </div>

            <div>
                {!! Form::label('nascimento', 'Data de nascimento') !!}
                {!! Form::date('nascimento', \Carbon\Carbon::now(), ['required' => '']) !!}

                {!! Form::label('senha', 'Senha') !!}
                {!! Form::password('senha', ['required' => '', 'placeholder' => 'Seu chave secreta']) !!}

                {!! Form::label('senha_confirmation', 'Confirmar') !!}
                {!! Form::password('senha_confirmation', ['required' => '', 'placeholder' => 'Confirma a chave secreta']) !!}
            </div>
        </section>

        <footer>
            <span class="texto-vermelho">{{ $errors->first() }}</span>
            <section>
                <input type="submit" value="Registrar super administrador" class="btn verde">
            </section>
        </footer>
    {!! Form::close() !!}

@endsection