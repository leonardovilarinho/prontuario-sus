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

            <section style="margin: 5px; padding: 5px; border: 1px solid #999999">
                <figure style="float:right; margin: 0">
                    <img src="{{ Storage::url('logo.jpg') }}" width="150" alt="Logo de {{ config('prontuario.hospital.nome') }}">
                </figure>
                <h3>{{ config('prontuario.hospital.nome') }}</h3>
                <small>{{ config('prontuario.hospital.local') }}</small>
            </section>

            <br><br><br>
            <p>
                <strong>Paciente: </strong>
                {{ $paciente->nome }}
            </p>

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
                @elseif($prescricao->autor->nao_medico)
                    <p>{{ $prescricao->autor->nome }} | {{ $prescricao->autor->nao_medico->conselho }}</p>
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