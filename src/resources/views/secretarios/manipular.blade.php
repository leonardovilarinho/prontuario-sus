@extends('layouts.app')

@if($secretario->usuario->nome == '')
    @section('titulo', 'Criar um novo secretário')
@else
    @section('titulo', 'Editar esse secretário')
@endif

@section('conteudo')
    @if($secretario->usuario->nome == '')
        <p>
           Aqui você pode cadastrar um novo secretário no sistema, os campos em vermelhos são obrigatórios, então devem ser preenchidos.
        </p>

        <p class="texto-vermelho" style="text-align: right">
            A senha padrão do usuário será o CPF do mesmo.
        </p>
    @else
        <p>
           Aqui você pode editar o registro de '{{ $secretario->usuario->nome }}', os campos em vermelhos são obrigatórios, então devem ser preenchidos.
        </p>
    @endif

    @if($secretario->usuario->nome == '')
        {!! Form::open(['url' => 'secretarios/novo', 'method' => 'post']) !!}
    @else
        {!! Form::open(['url' => 'secretarios/editar/'.$secretario->id, 'method' => 'post']) !!}
            {{ Form::hidden('_method', 'put') }}
    @endif
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', $secretario->usuario->nome, ['required' => '', 'placeholder' => 'Seu nome completo']) !!}
            </div>

             <div>
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', $secretario->usuario->email, ['required' => '', 'placeholder' => 'Seu endereço de email']) !!}

                {!! Form::label('cpf', 'CPF') !!}
                {!! Form::text('cpf', $secretario->usuario->cpf, ['required' => '', 'placeholder' => 'Seu número de CPF', 'maxlength' => 11]) !!}
            </div>

            <div>
                {!! Form::label('nascimento', 'Data de nascimento') !!}
                {!! Form::date('nascimento', $secretario->usuario->nascimento, ['required' => '']) !!}

                {!! Form::label('cargo', 'Cargo') !!}
                {!! Form::text('cargo', $secretario->cargo) !!}

				{!! Form::label('telefone', 'Telefone') !!}
                {!! Form::text('telefone', $secretario->telefone) !!}
            </div>

        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar esse secretário" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {!! Form::close() !!}

@endsection