@extends('layouts.app')

@section('titulo', 'Evoluções de ' . $paciente->nome)

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

    {{ Form::open(['url' => 'pacientes/'.$paciente->id.'/evolucoes', 'method' => 'get']) }}
        <section>
            <div>
                {{ Form::search('q', '',['placeholder' => 'Buscar por autor, horário, cid ou resumo']) }}
                {{ Form::submit('Buscar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
            </div>
        </section>
    {{ Form::close() }}

    <p>
        Aqui você pode gerenciar as evoluções do paciente <span class="texto-verde">{{ $paciente->nome }}</span>:
    </p>
    <br>
    
    @if(!auth()->user()->administrador)
        <a class="btn verde" href="{{ url('pacientes/'.$paciente->id.'/evolucoes/nova') }}">
            Cadastrar nova evolução
        </a>
    @endif

    <table>
        <tr>
            <td>Ações</td>
            <td>Autor</td>
            <td>Horário</td>
            <td>CID</td>
            <td>Posto</td>
            
        </tr>

        @foreach($paciente->evolucoess as $evolucao)
            <tr>
                <td>
                    @if(auth()->user()->administrador)
                        <a href="{{ url('pacientes/evolucoes/' . $evolucao->id . '/apagar') }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>
                    @endif
                    <a href="{{ url('pacientes/' . $paciente->id .'/evolucoes/'.$evolucao->id.'/detalhes') }}"
                    	class="btn verde"
                    >
                        Detalhes
                    </a>
                </td>
                <td>{{ $evolucao->autor->nome }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($evolucao->created_at)) }}</td>
                <td>{{ ($evolucao->cid  != null) ? $evolucao->cid : 'n/d' }}</td>
                <td>{{ $evolucao->cabecalho->nome . ' - ' . $evolucao->cabecalho->local }}</td>
            </tr>
        @endforeach

        <tfoot>
            <tr>
                <td>
                    <a href="{{ url('pacientes/'.$paciente->id.'/hevo') }}" class="btn verde">Histórico de evolução</a>
                </td>
            </tr>
        </tfoot>
    </table>

    <section style="text-align:center">
        {{ $paciente->evolucoess->links() }}
    </section>
@endsection