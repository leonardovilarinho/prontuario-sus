@extends('layouts.app')

@section('titulo', 'Finalizar a consulta')

@section('lateral')
@endsection

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
        Chegou a hora de finalizar o processo de nova consulta para a(o) médica(o) <span class="texto-verde">{{  $medico->usuario->nome }}</span>.
    </p>
    <br>

    <p><strong>Médica(o):</strong> {{ $medico->usuario->nome }}</p>
    <p><strong>Horário definido:</strong> {{ date('d/m/Y á\s H:i', strtotime($_GET['horario'])) }}</p>
    <p><strong>Paciente:</strong> {{ $paciente->nome }}</p>

    {{ Form::open(['url' => 'medicos/'.$medico->usuario_id.'/consulta/finalizar', 'method' => 'post']) }}

        {{ Form::hidden('paciente_id', $_GET['paciente']) }}
        {{ Form::hidden('horario', $_GET['horario']) }}
        {{ Form::hidden('medico_id', $medico->usuario_id) }}

        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                {{ Form::label('data', 'Data') }}
                {{ Form::date('data',
                    date('Y-m-d', strtotime($_GET['horario'])),
                    ['required' => '', 'readonly' => '']
                ) }}

                {{ Form::label('hor', 'Horário') }}
                <input type="time" name="hor" readonly required value="{{ date('H:i', strtotime($_GET['horario'])) }}">

            </div>

            <div>
                {{ Form::label('valor', 'Preço') }}
                {{ Form::number('valor',
                    0,
                    ['step' => '0.1']
                ) }}

                {{ Form::label('status', 'Estado') }}
                {{ Form::select('status', [
                        'Primeira' => 'Primeira',
                        'Retorno' => 'Retorno',
                        'Nova' => 'Nova',
                    ], '',
                    ['required' => '']
                ) }}
            </div>

            <div>
                {{ Form::label('obs', 'Observação') }}
                {{ Form::textarea('obs', '',
                    ['placeholder' => 'Observação sobre a consulta']
                ) }}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar essa consulta" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {{ Form::close() }}

@endsection