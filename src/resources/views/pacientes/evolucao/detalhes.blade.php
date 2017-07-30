@extends('layouts.app')

@section('titulo', 'Detalhes de evolução')

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
@endsection

@section('conteudo')

    <a href="{{ url('pacientes/'.$paciente->id.'/evolucoes') }}" class="btn secundaria">Voltar</a>

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
        <strong>CID: </strong>
        {{ $evolucao->cid }}
    </p>



    <section class="cartao" >
        <header>
            Evolução
        </header>
        <article id="imprimir">

            @if (auth()->user()->medico)
                @if(auth()->user()->medico->cabecalho)
                    <section style="margin: 5px; padding: 5px; border: 1px solid #999999">
                        <figure style="float:right; margin: 0">
                            <img src="{{ Storage::url('postos/'.auth()->user()->medico->cabecalho_id.'.jpg') }}" width="150" alt="Logo de {{ auth()->user()->medico->cabecalho->nome }}">
                        </figure>
                        <h3>{{ auth()->user()->medico->cabecalho->nome }}</h3>
                        <small>{{ auth()->user()->medico->cabecalho->local }}</small>
                    </section>
                @endif
            @endif
            

            <br><br><br>

            <p>
                <strong>Paciente: </strong>
                {{ $evolucao->paciente->nome }}
            </p>

            <hr>
            <p>
                {!! $evolucao->evolucao !!}
            </p>

            <hr>
            

            <br><br><br>
            <div style="text-align:center">
                <p>_______________________________________________________________</p>
                @if($evolucao->autor->medico)
                   <p>{{ $evolucao->autor->nome }} | {{ $evolucao->autor->medico->conselho }}</p>
                @elseif($evolucao->autor->nao_medico)
                    <p>{{ $evolucao->autor->nome }} | {{ $evolucao->autor->nao_medico->conselho }}</p>
                @endif
            </div>

            <hr>

            <p style="text-align: right;">
                <small>
                    <strong>Criado em: </strong>
                    {{ date('d/m/Y á\s H:i', strtotime($evolucao->created_at)) }}
                </small>
            </p>

        </article>
        <footer style="text-align: right">

            <a href="{{ url('pacientes/' . $paciente->id .'/evolucoes') }}" class="btn amarelo">Evoluções</a>

            <a href="{{ url('pacientes/' . $paciente->id .'/receituarios') }}" class="btn azul">Receituários</a>

            <a href="{{ url('pacientes/' . $paciente->id .'/prescricoes') }}" class="btn verde">Prescrição</a>

            <button onclick="printDiv('imprimir')" class="btn verde oculta-tel">Imprimir</button>

        </footer>
    </section>

    <small>
        <strong>Última edição: </strong>
        {{ date('d/m/Y á\s H:i', strtotime($evolucao->updated_at)) }}
    </small>

@endsection