@extends('layouts.app')

@if($posto->nome == '')
    @section('titulo', 'Criar um novo posto')
@else
    @section('titulo', 'Editar esse posto')
@endif

@section('conteudo')
    @if($posto->nome == '')
        <p>
           Aqui você pode cadastrar um novo posto no sistema, os campos em vermelhos são obrigatórios, então devem ser preenchidos.
        </p>
    @else
        <p>
           Aqui você pode editar o registro de '{{ $posto->nome }}', os campos em vermelhos são obrigatórios, então devem ser preenchidos.
        </p>
    @endif

    @if($posto->nome == '')
        {!! Form::open(['url' => 'postos/novo', 'method' => 'post', 'files' => true]) !!}
    @else
        {!! Form::open(['url' => 'postos/editar/'.$posto->id, 'method' => 'post', 'files' => true]) !!}
            {{ Form::hidden('_method', 'put') }}
    @endif
        <header>
            Por favor, preencha os campos:
        </header>

        <section>

            @if ($posto->nome != '')
                <figure style="text-align:center">
                    <img src="{{ Storage::url('postos/'.$posto->id.'.jpg') }}" width="250" alt="Logo de {{ $posto->local }}">
                </figure>
            @endif

            <div>
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', $posto->nome, ['required' => '', 'placeholder' => 'Nome completo posto']) !!}

                {!! Form::label('telefone', 'Telefone') !!}
                {!! Form::text('telefone', $posto->telefone, ['required' => '', 'placeholder' => 'Telefone do posto']) !!}
            </div>

            <div>
                {!! Form::label('endereco', 'Endereço') !!}
                {!! Form::text('endereco', $posto->endereco, ['required' => '', 'placeholder' => 'Endereço completo do posto']) !!}

                {!! Form::label('local', 'Cidade') !!}
                {!! Form::text('local', $posto->local, ['required' => '', 'placeholder' => 'Cidade do posto']) !!}
            </div>

            

            <div>   
                {!! Form::label('logo', 'Logomarca') !!}
                {!! Form::file('logo', ['accept' => 'image/*']) !!}
            </div>

        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar esse posto" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {!! Form::close() !!}

@endsection