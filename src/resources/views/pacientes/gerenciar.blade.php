@extends('layouts.app')

@section('titulo', 'Gerenciar paciente')

@section('lateral')
    {{--  <li><a href="#">Item person</a></li>  --}}
@endsection

@section('conteudo')

	<a href="{{ url('pacientes') }}" class="btn secundaria">Voltar</a>

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

    <section class="cartao" id="imprimir">
        <header>
            {{ $paciente->nome }}
        </header>
        <article>
        	<figure style="float: right; border: 1px solid #eee">
                <img src="{{ Storage::url('pacientes/'.$paciente->id.'.jpg') }}" width="150" alt="Foto de {{ $paciente->nome }}">
                <br>
                <small><a href="{{ url('pacientes/apagarfoto/'.$paciente->id) }}">Apagar imagem</a></small>
            </figure>

			<p>
            	<strong>Prontuário: </strong>
            	{{ $paciente->prontuario }}
            </p>

            <p>
            	<strong>Leito: </strong>
            	{{ $paciente->leito }}
            </p>

            <p>
            	<strong>Nascimento: </strong>
            	{{ date('d/m/Y', strtotime($paciente->nascimento)) }}
            </p>

            <p>
            	<strong>Sexo: </strong>
            	{{ $paciente->sexo }}
            </p>

            <p>
            	<strong>E. Civil: </strong>
            	{{ $paciente->civil }}
            </p>

            <p>
            	<strong>Cor: </strong>
            	{{ $paciente->cor }}
            </p>

            <p>
            	<strong>CPF: </strong>
            	{{ $paciente->cpf }}
            </p>

            <p>
            	<strong>Convênio: </strong>
            	{{ $paciente->convenio }}
            </p>

            <p>
            	<strong>N. Convênio: </strong>
            	{{ $paciente->num_convenio }}
            </p>

            <p>
            	<strong>Nível de instrução: </strong>
            	{{ $paciente->grau }}
            </p>

            <p>
            	<strong>Naturalidade: </strong>
            	{{ $paciente->naturalidade }}
            </p>

			<p>
            	<strong>Profissão: </strong>
            	{{ $paciente->profissao }}
            </p>

            <hr>

            <p>
            	<strong>Telefone: </strong>
            	{{ $paciente->telefone }}
            </p>

            <p>
            	<strong>Email: </strong>
            	{{ $paciente->email }}
            </p>

            <p>
            	<strong>CEP: </strong>
            	{{ $paciente->cep }}
            </p>

            <p>
            	<strong>Endereço: </strong>
            	{{ $paciente->endereco }}
            </p>

            <p>
            	<strong>Bairro: </strong>
            	{{ $paciente->bairro }}
            </p>

            <p>
            	<strong>Cidade: </strong>
            	{{ $paciente->cidade }} - {{ $paciente->uf }}
            </p>
            
            <hr>

            <p>
            	<strong>Observação: </strong>
            	{!! $paciente->obs !!}
            </p>

            <hr>

            <p style="text-align: right;">
            	<small>
            		<strong>Criado em: </strong>
	            	{{ date('d/m/Y á\s H:i', strtotime($paciente->created_at)) }}
					|
	            	<strong>Última edição: </strong>
	            	{{ date('d/m/Y á\s H:i', strtotime($paciente->updated_at)) }}
            	</small>
            </p>

        </article>
        <footer style="text-align: right">

        	@if(auth()->user()->secretario)
                <a href="{{ url('pacientes/apagar/' . $paciente->id) }}" onclick="return confirm('Deseja apagar?')" class="btn vermelho">Apagar</a>
                <a href="{{ url('pacientes/editar/' . $paciente->id) }}" class="btn amarelo">Editar</a>

                <a href="{{ url('pacientes/' . $paciente->id .'/consultas') }}" class="btn verde">Consultas</a>
            @else
                <a href="{{ url('pacientes/' . $paciente->id .'/evolucoes') }}" class="btn amarelo">Evoluções</a>

                <a href="{{ url('pacientes/' . $paciente->id .'/receituarios') }}" class="btn azul">Receituários</a>

                <a href="{{ url('pacientes/' . $paciente->id .'/prescricoes') }}" class="btn verde">Prescrição</a>
            @endif
            <button onclick="printDiv('imprimir')" class="btn verde oculta-tel">Imprimir</button>
        </footer>
    </section>

@endsection