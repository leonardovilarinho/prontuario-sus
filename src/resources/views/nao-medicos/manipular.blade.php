@extends('layouts.app')

@if($nmedico->usuario->nome == '')
    @section('titulo', 'Criar um novo profissional')
@else
    @section('titulo', 'Editar esse profissional')
@endif


@section('conteudo')
    @if($nmedico->usuario->nome == '')
        <p>
           Aqui você pode cadastrar um novo profissional no sistema, os campos em vermelhos são obrigatórios, então devem ser preenchidos.
        </p>

        <p class="texto-vermelho" style="text-align: right">
            A senha padrão do usuário será o CPF do mesmo.
        </p>
    @else
        <p>
           Aqui você pode editar o registro de '{{ $nmedico->usuario->nome }}', os campos em vermelhos são obrigatórios, então devem ser preenchidos.
        </p>
    @endif

    @if($nmedico->usuario->nome == '')
        {!! Form::open(['url' => 'nao-medicos/novo', 'method' => 'post']) !!}
    @else
        {!! Form::open(['url' => 'nao-medicos/editar/'.$nmedico->id, 'method' => 'post']) !!}
            {{ Form::hidden('_method', 'put') }}
    @endif
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', $nmedico->usuario->nome, ['required' => '', 'placeholder' => 'Seu nome completo']) !!}
            </div>

             <div>
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', $nmedico->usuario->email, ['required' => '', 'placeholder' => 'Seu endereço de email']) !!}

                {!! Form::label('cpf', 'CPF') !!}
                {!! Form::text('cpf', $nmedico->usuario->cpf, ['required' => '', 'placeholder' => 'Seu número de CPF', 'maxlength' => 11]) !!}
            </div>

            <div>
                {!! Form::label('nascimento', 'Data de nascimento') !!}
                {!! Form::date('nascimento', $nmedico->usuario->nascimento, ['required' => '']) !!}

                {!! Form::label('cargo', 'Cargo') !!}
                {!! Form::text('cargo', $nmedico->cargo) !!}

                {!! Form::label('especialidade', 'Especialidade') !!}
                {!! Form::text('especialidade', $nmedico->especialidade) !!}
            </div>

            <div>
                {!! Form::label('conselho', 'Conselho regional') !!}
                {!! Form::text('conselho', $nmedico->conselho) !!}

                {!! Form::label('telefone', 'Telefone(s)') !!}
                {!! Form::text('telefone', $nmedico->telefone) !!}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar esse profissional" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {!! Form::close() !!}

@endsection