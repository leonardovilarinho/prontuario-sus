@extends('layouts.app')

@section('titulo', 'Configurações do hospital')

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
       Aqui você pode editar as configurações do hospital, onde os campos em vermelhos são obrigatórios.
    </p>

    <p class="texto-vermelho">
        <strong>Obs:</strong> As alterações podem demorar a serem vistas.
    </p>


    {!! Form::open(['url' => 'hospital/config', 'method' => 'post', 'files' => true]) !!}
        <header>
            Por favor, preencha os campos:
        </header>

        <section>
            <div>
                <label>CID obrigatório?</label>
                <div class="selecao">
                    <input type="radio" id="sim" name="cid" value="1" {{ config('prontuario.config.cid') ? 'checked' : '' }}/>
                    <label for="sim">Sim</label>

                    <input type="radio" id="nao" name="cid" value="0" {{ !config('prontuario.config.cid') ? 'checked' : '' }}/>
                    <label for="nao">Não</label>
                </div>
            </div>

            <div>
                <label>Diagnóstivo obrigatório?</label>
                <div class="selecao">
                    <input type="radio" id="simd" name="diagnostico" value="1" {{ config('prontuario.config.diagnostico') ? 'checked' : '' }}/>
                    <label for="simd">Sim</label>

                    <input type="radio" id="naod" name="diagnostico" value="0" {{ !config('prontuario.config.diagnostico') ? 'checked' : '' }}/>
                    <label for="naod">Não</label>
                </div>
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar essas informações" class="btn verde">
            </section>

            @if($errors->first())
                <span class="texto-vermelho">{{ $errors->first() }}</span>
            @endif
            

            @if(session('msg'))
                <span class="texto-verde">{{ session('msg') }}</span>
            @endif
        </footer>
    {!! Form::close() !!}

@endsection