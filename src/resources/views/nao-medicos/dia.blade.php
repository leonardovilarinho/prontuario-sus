@extends('layouts.app')

@section('titulo', 'Seu dia')

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

    {{ Form::open(['url' => 'nao-medicos/lugar', 'method' => 'post']) }}
		<section>
			<div>
				<span style="font-size: 18pt; margin-right: 5px">Hoje você está no: </span> 
				{{ Form::select('posto', $postos + ['' => 'Nenhum'], (auth()->user()->nao_medico->cabecalho) ? auth()->user()->nao_medico->cabecalho_id : '', ['required' => '']) }}

				{{ Form::submit('Alterar', ['class' => 'btn verde', 'style' => 'flex-grow: 1; margin-left: 3px']) }}
			</div>
		</section>
    {{ Form::close() }}
@endsection