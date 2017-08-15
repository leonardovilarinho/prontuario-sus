@extends('layouts.app')

@section('titulo', 'Lista de consultas')

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
        A seguir são exibidas as consultas marcadas para <span class="texto-verde">{{ ($tipo == 'med') ? $medico->usuario->nome : $paciente->nome }}</span>:
    </p>
    <br>




    @if($tipo == 'med')
        {{ Form::open(['url' => 'medicos/'.$medico->usuario_id.'/consultas', 'method' => 'get']) }}
            <section>
                <div>
                    {{ Form::search('q', '',['placeholder' => 'Buscar por data, hora, paciente (nome, email ou cpf) ou status']) }}
                    {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
                </div>
            </section>
        {{ Form::close() }}
    @else
        {{ Form::open(['url' => 'pacientes/'.$paciente->id.'/consultas', 'method' => 'get']) }}
            <section>
                <div>
                    {{ Form::search('q', '',['placeholder' => 'Buscar por data, hora, paciente (nome, email ou cpf) ou status']) }}
                    {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
                </div>
            </section>
        {{ Form::close() }}
    @endif

    @if($tipo == 'med')
        <a class="btn verde" href="{{ url('medicos/'.$medico->usuario_id.'/consulta/data') }}">
            Cadastrar nova consulta
        </a>
    @endif

	<table>
        <tr>
            <td>Ações</td>
            @if($tipo == 'med')
                <td>Tempo</td>
            @endif
            <td>Horário</td>
            @if($tipo == 'med')
                <td>Paciente</td>
            @else
                <td>Médico</td>
            @endif
            <td>Estado</td>
            <td>Preço</td>
            <td>Observação</td>
        </tr>

        @foreach($consultas as $consulta)
            <tr>
                <td>
                    <a onclick="return confirm('Deseja cancelar essa consulta?')"
                    href="{{ url('medicos/'.$consulta->medico_id.'/consulta/'.$consulta->id.'/cancelar') }}"
                    class="btn vermelho">
                        Cancelar
                    </a>
                </td>

                @if($tipo == 'med')
                    <td>

                        @if($consulta->atendida)
                            <a href="#" class="btn verde">Concluída</a>
                        @else
                            <a href="#" class="btn vermelho">Pendente</a>
                        @endif
                    </td>
                @endif

                <td>{{ date('d/m/Y á\s H:i', strtotime($consulta->horario)) }}</td>
                @if($tipo == 'med')
                    <td>{{ $consulta->paciente->nome }}</td>
                @else
                    <td>{{ $consulta->medico->nome }}</td>
                @endif
                <td>{{ $consulta->status }}</td>
                <td>R$ {{ number_format($consulta->valor, 2, ',', '.') }}</td>
                <td>{{ $consulta->obs }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $consultas->links() }}
    </section>

@endsection