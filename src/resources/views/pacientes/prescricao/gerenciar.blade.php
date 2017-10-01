@extends('layouts.app')

@section('titulo', 'Gerenciar prescrição')

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
@endsection

@section('conteudo')

    <a href="{{ url('pacientes/'.$paciente->id.'/prescricoes') }}" class="btn secundaria">Voltar</a>

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


    <section class="cartao">
        <header>
            {{ $prescricao->nome }}
        </header>
        <article id="imprimir">

            <section style="margin: 5px; padding: 5px; border: 1px solid #999999; height: 100px">
                <figure style="float:right; margin: 0">
                    <img src="{{ Storage::url('postos/'.$prescricao->cabecalho->id.'.jpg') }}" height="100" alt="Logo de {{ $prescricao->cabecalho->nome }}">
                </figure>
                <h3>{{ $prescricao->cabecalho->nome }}</h3>
                <small>{{ $prescricao->cabecalho->local }}</small>
            </section>

            <br><br><br>
            <p>
                <strong>Paciente: </strong>
                {{ $paciente->nome }}
            </p>
            <ul>
                <li><strong>Nascimento:</strong>{{ date('d/m/Y', strtotime($paciente->nascimento)) }}</li>
                <li><strong>Idade:</strong>{{ Saudacoes::idade($paciente->nascimento) }}</li>
                <li><strong>Convênio:</strong>{{ $paciente->convenio }}</li>
            </ul>

            <label><strong>Medicamentos:</strong></label>
            <ul class="lista-comum">
                @foreach ($prescricao->medicamentos as $medicamento)
                    <li>
                        <span>
                            {{ $medicamento->nome }}
                            ( {{ $medicamento->pivot->dose }} ) - 
                            por {{ $medicamento->pivot->tempo }} dias, de
                            {{ $medicamento->pivot->intervalo }} em {{ $medicamento->pivot->intervalo }} horas
                        </span>
                        <div class="direita">
                            <a href="{{ url('pacientes/'.$paciente->id.'/prescricoes/'.$prescricao->id.'/remmed/'.$medicamento->pivot->id) }}" class="btn verde">Apagar</a>
                        </div>
                    </li>
                @endforeach
            </ul>

            <label><strong>Equipamentos:</strong></label>
            <ul class="lista-azul">
                @foreach ($prescricao->equipamentos as $equipamento)
                    <li>
                        <span>
                            {{ $equipamento->nome }}
                        </span>

                        <div class="direita">
                            <a href="{{ url('pacientes/'.$paciente->id.'/prescricoes/'.$prescricao->id.'/remequ/'.$equipamento->pivot->id) }}" class="btn verde">Apagar</a>
                        </div>
                    </li>
                @endforeach
            </ul>

            <br><br><br>
            <div style="text-align:center">
                <p>_______________________________________________________________</p>
                @if($prescricao->autor->medico)
                   <p>{{ $prescricao->autor->nome }} | {{ $prescricao->autor->medico->conselho }}</p>
                   <p><strong>{{ $prescricao->autor->medico->especialidade }}</strong></p>
                @elseif($prescricao->autor->nao_medico)
                    <p>{{ $prescricao->autor->nome }} | {{ $prescricao->autor->nao_medico->conselho }}</p>
                    <p><strong>{{ $prescricao->autor->nao_medico->especialidade }}</strong></p>
                @endif
            </div>

            <hr>

            <p style="text-align: right;">
                <small>
                    <strong>Criado em: </strong>
                    {{ date('d/m/Y á\s H:i', strtotime($prescricao->created_at)) }}
                </small>
            </p>

        </article>
        <footer style="text-align: right">
            @if(!auth()->user()->administrador)
                <a href="{{ url('pacientes/' . $paciente->id.'/prescricoes/'.$prescricao->id.'/addmed') }}"
                class="btn azul">Add Medicamento</a>

                <a href="{{ url('pacientes/' . $paciente->id.'/prescricoes/'.$prescricao->id.'/addequ') }}"
                class="btn amarelo">Add Equipamento</a>
            @endif

            <a href="{{ url('pacientes/' . $paciente->id .'/evolucoes') }}" class="btn amarelo">Evoluções</a>

            <a href="{{ url('pacientes/' . $paciente->id .'/receituarios') }}" class="btn azul">Receituários</a>

            <a href="{{ url('pacientes/' . $paciente->id .'/prescricoes') }}" class="btn verde">Prescrição</a>
            <button onclick="printDiv('imprimir')" class="btn verde  oculta-tel">Imprimir</button>
        </footer>
    </section>
    <small>
        <strong>Última edição: </strong>
        {{ date('d/m/Y á\s H:i', strtotime($prescricao->updated_at)) }}
    </small>

@endsection