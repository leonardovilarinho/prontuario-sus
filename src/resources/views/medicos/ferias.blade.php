@extends('layouts.app')

@section('titulo', 'Gerenciamento de férias')

@section('conteudo')
	<p style="text-align:center">
        @if(session('msg'))
            <span class="texto-verde">
                {{ session('msg') }}
            </span>
        @endif
    </p>

    <p>
       Aqui você pode informar se você está ou não no seu período de férias, em caso de férias, não teremos consultas marcadas para você.
    </p>

    {!! Form::open(['url' => 'medicos/ferias', 'method' => 'post']) !!}
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                <label>Estou de férias?</label>
                <div class="selecao">
                    <input type="radio" id="sim" name="ferias" value="1" {{ auth()->user()->medico->ferias ? 'checked' : '' }}/>
                    <label for="sim">Sim</label>

                    <input type="radio" id="nao" name="ferias" value="0" {{ !auth()->user()->medico->ferias ? 'checked' : '' }}/>
                    <label for="nao">Não</label>
                </div>
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar informações" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {!! Form::close() !!}

@endsection