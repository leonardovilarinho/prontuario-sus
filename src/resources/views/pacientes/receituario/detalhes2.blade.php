@extends('layouts.app')

@section('titulo', 'Detalhes de receita controlada')

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
@endsection

@section('conteudo')

    <a href="{{ url('pacientes/'.$paciente->id.'/receituarios') }}" class="btn secundaria">Voltar</a>

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
            Receituário controlado
        </header>
        <article id="imprimir">
            <section style="margin: 5px; padding: 5px; border: 1px solid #999999; height: 100px">
                <figure style="float:right; margin: 0">
                    <img src="{{ Storage::url('postos/'.$receita->cabecalho->id.'.jpg') }}" height="100" alt="Logo de {{ $receita->cabecalho->nome }}">
                </figure>
                <h3>{{ $receita->cabecalho->nome }}</h3>
                <small>{{ $receita->cabecalho->local }}</small>
            </section>        

            <section style="margin: 2px 5px; padding: 5px; border: 1px solid #999999; font-size:10pt; max-width:35%">
                <h4 style="margin-top:-5px">IDENTIFICAÇÃO DO EMITENTE</h4>
                <p>NOME: {{ $receita->autor->nome }}</p>
                <p>CRM: {{ $receita->medico()                                                                       ->conselho }}</p>
                <p>ENDEREÇO: {{ $receita->cabecalho->endereco }}</p>
                <p>TELEFONE: {{ $receita->cabecalho->telefone }}</p>
                <p>CIDADE: {{ $receita->cabecalho->local }}</p>
            </section>

<br>


            <p>
                <strong>Paciente: </strong>
                {{ $receita->paciente->nome }}
            </p>

            <hr>

            <p>
                {!! $receita->conteudo !!}
            </p>

            <br><br>

            <p style="text-align: right;">
                <small>
                    <strong>Criado em: </strong>
                    {{ date('d/m/Y á\s H:i', strtotime($receita->created_at)) }}
                </small>
            </p>

            <section style="display: flex; font-size:10pt">
                <article style="width: 49%; border: 1px solid #999999; margin: 2px 5px;">
                    <h4 style="margin-top:-5px">IDENTIFICAÇÃO DO COMPRADOR</h4>
                    <p>NOME:</p>
                    <br>
                    <p>IDENTIDADE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EMISSOR: </p>
                    <p>ENDEREÇO: </p>
                    <br>
                    <p>CIDADE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UF: </p>
                    <p>TELEFONE: </p>
                </article>

                <article style="width: 49%; border: 1px solid #999999; margin: 2px 5px;">
                    <h4 style="margin-top:-5px">IDENTIFICAÇÃO DO FORNECEDOR</h4>
                    <br>
                    <div style="text-align:center">
                        <p>_________________________________________________________</p>
                        <p>Assinatura do farmacêutico</p>
                    </div>
                    <br>
                    <p style="text-align:center">DATA: {{ date('d/m/Y') }}</p>
                    
                </article>
            </section>

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
        {{ date('d/m/Y á\s H:i', strtotime($receita->updated_at)) }}
    </small>

@endsection