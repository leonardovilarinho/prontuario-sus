@extends('layouts.app')

@section('titulo', 'Gerenciamento de horários')

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

            <hr>

            <p>Selecione os dias a trabalhar:</p>
            <div>
                <label>Segunda&nbsp;</label>
                <div class="marcador">
                    <input type="checkbox" id="segunda" name="segunda" value="1"
                        <?php echo $usuario->dia->segunda ? 'checked' : '' ?> />
                    <label for="segunda">Segunda</label>
                </div>

                <label>Terça</label>
                <div class="marcador">
                    <input type="checkbox" id="terca" name="terca" value="1"
                        <?php echo $usuario->dia->terca ? 'checked' : '' ?>/>
                    <label for="terca">Terça</label>
                </div>

                <label>Quarta&nbsp;</label>
                <div class="marcador">
                    <input type="checkbox" id="quarta" name="quarta" value="1"
                        <?php echo $usuario->dia->quarta ? 'checked' : '' ?> />
                    <label for="quarta">Quarta</label>
                </div>
            </div>

            <div>
                <label>Quinta&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <div class="marcador">
                    <input type="checkbox" id="quinta" name="quinta" value="1"
                        <?php echo $usuario->dia->quinta ? 'checked' : '' ?> />
                    <label for="quinta">Quinta</label>
                </div>

                <label>Sexta</label>
                <div class="marcador">
                    <input type="checkbox" id="sexta" name="sexta" value="1"
                        <?php echo $usuario->dia->sexta ? 'checked' : '' ?> />
                    <label for="sexta">Sexta</label>
                </div>

                <label>Sábado</label>
                <div class="marcador">
                    <input type="checkbox" id="sabado" name="sabado" value="1"
                        <?php echo $usuario->dia->sabado ? 'checked' : '' ?> />
                    <label for="sabado">Sábado</label>
                </div>
            </div>

            <div>
                <label>Domingo</label>
                <div class="marcador">
                    <input type="checkbox" id="domingo" name="domingo" value="1"
                        <?php echo $usuario->dia->domingo ? 'checked' : '' ?> />
                    <label for="domingo">Domingo</label>
                </div>
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
@endsection