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

            <section style="margin: 5px; padding: 5px; border: 1px solid #999999; height: 100px">
                <figure style="float:right; margin: 0">
                    <img src="{{ Storage::url('postos/'.$evolucao->cabecalho->id.'.jpg') }}" height="100" alt="Logo de {{ $evolucao->cabecalho->nome }}">
                </figure>
                <h3>{{ $evolucao->cabecalho->nome }}</h3>
                <small>{{ $evolucao->cabecalho->local }}</small>
            </section>
            

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
                   <p><strong>{{ $evolucao->autor->medico->especialidade }}</strong></p>
                @elseif($evolucao->autor->nao_medico)
                    <p>{{ $evolucao->autor->nome }} | {{ $evolucao->autor->nao_medico->conselho }}</p>
                    <p><strong>{{ $evolucao->autor->nao_medico->especialidade }}</strong></p>
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

            @if(auth()->user()->administrador)
                <a href="{{ url('pacientes/evolucoes/'.$evolucao->id.'/apagar') }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>
            @endif

            @if(auth()->user()->id == $evolucao->autor->id and strtotime($evolucao->autor->created_at . '+2days') > time() )
                <a href="{{ url('pacientes/evolucoes/'.$evolucao->id.'/apagar') }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>
            @endif

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