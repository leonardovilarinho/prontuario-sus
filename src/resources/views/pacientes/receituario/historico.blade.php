@extends('layouts.app')

@section('titulo', 'Histórico de receitas de ' . $paciente->nome)

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

    <a href="{{ url('pacientes/'.$paciente->id.'/receituarios') }}" class="btn secundaria">Voltar</a>


    <p>
        Histórico de receitas de <span class="texto-verde">{{ $paciente->nome }}</span>:
    </p>
    <br>

    <section>
        @foreach($paciente->receitas as $rec)
            <article style="margin-top: 20px">
                <h3>{{ date('d/m/Y ás H:i', strtotime($rec->created_at)) }} - {{ $rec->autor->nome }}</h3>

                <div>{!! $rec->conteudo !!}</div>
            </article>
        @endforeach
    </section>
@endsection