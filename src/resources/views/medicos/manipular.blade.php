@extends('layouts.app')

@if($medico->usuario->nome == '')
    @section('titulo', 'Criar um novo médico')
@else
    @section('titulo', 'Editar esse médico')
@endif

@section('conteudo')
    @if($medico->usuario->nome == '')
        <p>
           Aqui você pode cadastrar um novo médico no sistema, os campos em vermelhos são obrigatórios, então devem ser preenchidos.
        </p>

        <p class="texto-vermelho" style="text-align: right">
            A senha padrão do usuário será o CPF do mesmo.
        </p>
    @else
        <p>
           Aqui você pode editar o registro de '{{ $medico->usuario->nome }}', os campos em vermelhos são obrigatórios, então devem ser preenchidos.
        </p>
    @endif

    @if($medico->usuario->nome == '')
        {!! Form::open(['url' => 'medicos/novo', 'method' => 'post']) !!}
    @else
        {!! Form::open(['url' => 'medicos/editar/'.$medico->id, 'method' => 'post']) !!}
            {{ Form::hidden('_method', 'put') }}
    @endif
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', $medico->usuario->nome, ['required' => '', 'placeholder' => 'Seu nome completo']) !!}
            </div>

             <div>
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', $medico->usuario->email, ['required' => '', 'placeholder' => 'Seu endereço de email']) !!}

                {!! Form::label('cpf', 'CPF') !!}
                {!! Form::text('cpf', $medico->usuario->cpf, ['required' => '', 'placeholder' => 'Seu número de CPF', 'maxlength' => 11]) !!}
            </div>

            <div>
                {!! Form::label('nascimento', 'Data de nascimento') !!}
                {!! Form::date('nascimento', $medico->usuario->nascimento, ['required' => '']) !!}

                {!! Form::label('cargo', 'Cargo') !!}
                {!! Form::text('cargo', $medico->cargo) !!}

                {!! Form::label('especialidade', 'Especialidade') !!}
                {!! Form::text('especialidade', $medico->especialidade) !!}
            </div>

            <div>
                {!! Form::label('conselho', 'Conselho regional') !!}
                {!! Form::text('conselho', $medico->conselho) !!}

                {!! Form::label('telefone', 'Telefone') !!}
                {!! Form::text('telefone', $medico->telefone) !!}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar esse médico" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {!! Form::close() !!}

@endsection