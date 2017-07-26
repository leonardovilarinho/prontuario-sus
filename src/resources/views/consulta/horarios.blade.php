@extends('layouts.app')

@section('titulo', 'Selecionar horário para consulta')

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

    <p>
        Por favor, para continuar o processo de nova consulta para a(o) médica(o) <span class="texto-verde">{{  $medico->usuario->nome }}</span>, selecione um horário para a consulta a seguir:
    </p>
    <br>

    <p><strong>Médica(o):</strong> {{ $medico->usuario->nome }}</p>
    <p><strong>Data definida:</strong> {{ date('d/m/Y', strtotime($_GET['data'])) }}</p>
    <p><strong>Início de trabalho:</strong> {{ $inicio->format('d/m/Y á\s H:i') }}</p>
    <p><strong>Fim de trabalho:</strong> {{ $fim->format('d/m/Y á\s H:i') }}</p>


    {{ Form::open(['url' => 'medicos/'.$medico->usuario_id.'/consulta/marcar', 'method' => 'get']) }}
        <section>
            <div>
                <div class="selecao" style="flex-wrap: wrap">

                	@foreach($periodo as $data)
					    <input type="radio" id="{{ $data->format('Hi') }}" name="horario"
                            value="{{ $data->format('Y-m-d H:i') }}"
                            {{ in_array($data->format('Y-m-d H:i'), $consultas) ? 'disabled' : '' }}
                            {{ ($data < $agora) ? 'disabled' : '' }}
                        />
                    	<label for="{{ $data->format('Hi') }}">{{ $data->format('d á\s H:i') }}</label>
                    @endforeach
                </div>
            </div>
        </section>

         <footer>
            <section>
                <input type="submit" value="Prosseguir" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {{ Form::close() }}

@endsection