@extends('layouts.app')

@section('titulo', 'Receitas de ' . $paciente->nome)

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
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

    <a href="{{ url('pacientes/gerenciar/'.$paciente->id) }}" class="btn secundaria">Voltar</a>

    {{ Form::open(['url' => 'pacientes/'.$paciente->id.'/receituarios', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por autor, horário, conteúdo']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

    <p>
        Aqui você pode gerenciar as evoluções do paciente <span class="texto-verde">{{ $paciente->nome }}</span>:
    </p>
    <br>

    @if(!auth()->user()->administrador)
        <a class="btn verde" href="{{ url('pacientes/'.$paciente->id.'/receituarios/novo') }}">
            Cadastrar novo receituario
        </a>
    @endif

    <table>
        <tr>
            <td>Ações</td>
            <td>Autor</td>
            <td>Controlado?</td>
            <td>Horário</td>
        </tr>

        @foreach($paciente->receituarios as $receituario)
            <tr>
                <td>
                    @if(auth()->user()->administrador)
                        <a href="{{ url('pacientes/receituarios/' . $receituario->id . '/apagar') }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>
                    @endif
                        @if($receituario->controle)
                            <a href="{{ url('pacientes/' . $paciente->id .'/receituarios/'.$receituario->id.'/detalhes2') }}"
                                class="btn verde"
                            >
                                Detalhes
                            </a>
                        @else
                            <a href="{{ url('pacientes/' . $paciente->id .'/receituarios/'.$receituario->id.'/detalhes') }}"
                                class="btn verde"
                            >
                                Detalhes
                            </a>
                        @endif
                </td>
                <td>{{ $receituario->autor->nome }}</td>
                <td>{{ $receituario->controle ? 'Sim' : 'Não' }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($receituario->created_at)) }}</td>
            </tr>
        @endforeach
    </table>

    <section style="text-align:center">
        {{ $paciente->receituarios->links() }}
    </section>
@endsection