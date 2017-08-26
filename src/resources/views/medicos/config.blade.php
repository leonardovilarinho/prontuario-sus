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
       A seguir você pode editar qual horário você começa e termina o trabalho, defina também a duração média de cada consulta. Assim nós podemos montar os horários para agendamento de suas consultas automaticamente.
    </p>

    <p class="texto-vermelho">
        <strong>Obs:</strong> As alterações só serão feitas para novas consultas.
    </p>

    {!! Form::open(['url' => 'medicos/config/carga', 'method' => 'post', 'files' => true]) !!}
        {{ Form::hidden('medico_id', auth()->user()->id) }}
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {!! Form::label('inicio', 'Início de trabalho (horário)') !!}
                {!! Form::time('inicio', date('H:i', strtotime($carga->inicio)) , ['required' => '', 'placeholder' => 'Horas que você inicia o trabalho']) !!}

                {!! Form::label('fim', 'Fim de trabalho (horário)') !!}
                {!! Form::time('fim', date('H:i', strtotime($carga->fim)), ['required' => '', 'placeholder' => 'Horas que você termina o trabalho']) !!}
            </div>

            <div>
                {!! Form::label('intervalo', 'Duração média de consulta (em minutos)') !!}
                {!! Form::number('intervalo', $carga->intervalo , ['required' => '', 'placeholder' => 'Tempo médio de consulta em minutos']) !!}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar minha carga horária" class="btn verde">
            </section>

            @if($errors->first())
                <span class="texto-vermelho">{{ $errors->first() }}</span>
            @endif
        </footer>
    {!! Form::close() !!}

    <br><br>

    <p>
       Abaixo você pode informar se você está ou não no seu período de férias, em caso de férias, não teremos consultas marcadas para você.
    </p>

    {!! Form::open(['url' => 'medicos/config/ferias', 'method' => 'post']) !!}
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                <label>Estou de férias?</label>
                <div class="selecao">
                    <input type="radio" id="sim" name="ferias" value="1" {{ $usuario->ferias ? 'checked' : '' }}/>
                    <label for="sim">Sim</label>

                    <input type="radio" id="nao" name="ferias" value="0" {{ !$usuario->ferias ? 'checked' : '' }}/>
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