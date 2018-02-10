@extends('layouts.app')

@if($paciente->nome == '')
    @section('titulo', 'Criar um novo paciente')
@else
    @section('titulo', 'Editar esse paciente')
@endif

@section('conteudo')
    @if($paciente->nome == '')
        <p>
           Aqui você pode cadastrar um novo paciente no sistema, os campos em vermelhos são obrigatórios, então devem ser preenchidos.
        </p>
    @else
        <p>
           Aqui você pode editar o registro de '{{ $paciente->nome }}', os campos em vermelhos são obrigatórios, então devem ser preenchidos.
        </p>
    @endif

    @if($paciente->nome == '')
        {!! Form::open(['url' => 'pacientes/novo', 'method' => 'post', 'files' => true]) !!}
    @else
        {!! Form::open(['url' => 'pacientes/editar/'.$paciente->id, 'method' => 'post', 'files' => true]) !!}
            {{ Form::hidden('_method', 'put') }}
    @endif
        <header>
            Por favor, preencha os campos:
        </header>

        <section>

            @if($paciente->nome != '')
                <figure style="text-align:center">
                    <img src="{{ Storage::url('pacientes/'.$paciente->id.'.jpg') }}" width="150" alt="Foto de {{ $paciente->nome }}">
                </figure>
            @endif

            <div>
                    {!! Form::label('foto', 'Editar foto 3x4') !!}
                    {!! Form::file('foto', ['accept' => 'image/*']) !!}
                </div>

            <div>
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', $paciente->nome, ['required' => '', 'placeholder' => 'Nome completo']) !!}

                {!! Form::label('prontuario', 'N.Prontuário') !!}
                {!! Form::text('prontuario', $paciente->prontuario, ['required' => '', 'readonly' => '']) !!}

                {!! Form::label('leito', 'Leito') !!}
                {!! Form::text('leito', $paciente->leito, [ 'placeholder' => 'Leito de hospital']) !!}
            </div>

            <div>
                {!! Form::label('nascimento', 'Nascimento') !!}
                {!! Form::date('nascimento', $paciente->nascimento, ['placeholder' => 'Data de nascimento', 'required' => '']) !!}

                {!! Form::label('sexo', 'Sexo') !!}
                {!! Form::select('sexo', ['Masculino' => 'Masculino', 'Feminino' => 'Feminino', '' => 'Selecione algum'], ($paciente->sexo == null) ? '': $paciente->sexo) !!}

                {!! Form::label('civil', 'E. Civil') !!}
                {!! Form::select('civil', ['Solteiro' => 'Solteiro', 'Divorciado' => 'Divorciado', 'Casado' => 'Casado', 'Viúvo' => 'Viúvo', 'Separado' => 'Separado', '' => 'Selecione algum'],($paciente->civil == null) ? '' : $paciente->civil) !!}

                {!! Form::label('cor', 'Cor') !!}
                {!! Form::select('cor', ['Preta' => 'Preta', 'Branca' => 'Branca', 'Parda' => 'Parda', 'Indigena' => 'Indigena', 'Amarela' => 'Amarela', 'Não declarado' => 'Não declarado', '' => 'Selecione algum'], ($paciente->cor == null) ? '' : $paciente->cor ) !!}
            </div>

            <div>
                {!! Form::label('cpf', 'CPF') !!}
                {!! Form::text('cpf', $paciente->cpf, ['placeholder' => 'Número do CPF']) !!}

                {!! Form::label('convenio', 'Convênio') !!}
                {!! Form::text('convenio', $paciente->convenio, ['placeholder' => 'Nome do convênio', 'required' => '']) !!}

                {!! Form::label('num_convenio', 'N. Convênio') !!}
                {!! Form::text('num_convenio', $paciente->num_convenio, ['placeholder' => 'Número do convênio']) !!}
            </div>

            <div>
                {!! Form::label('grau', 'Instrução') !!}
                {!! Form::text('grau', $paciente->grau, ['placeholder' => 'Grau de Instrução']) !!}

                {!! Form::label('naturalidade', 'Natural') !!}
                {!! Form::text('naturalidade', $paciente->naturalidade, ['placeholder' => 'Naturalidade']) !!}

                {!! Form::label('profissao', 'Profissão') !!}
                {!! Form::text('profissao', $paciente->profissao, ['placeholder' => 'Profissão']) !!}
            </div>

            <h4>Contato:</h4>

            <div>
                {!! Form::label('telefone', 'Telefone(s)') !!}
                {!! Form::text('telefone', $paciente->telefone, ['placeholder' => 'Número do telefone']) !!}

                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', $paciente->email, ['placeholder' => 'Endereço de email']) !!}

                {!! Form::label('cep', 'CEP') !!}
                {!! Form::text('cep', $paciente->cep, ['placeholder' => 'Número do CEP']) !!}
            </div>

            <div>
                {!! Form::label('endereco', 'Endereço') !!}
                {!! Form::text('endereco', $paciente->endereco, ['placeholder' => 'Detalhe do endereço']) !!}
            </div>

            <div>
                {!! Form::label('bairro', 'Bairro') !!}
                {!! Form::text('bairro', $paciente->bairro, ['placeholder' => 'Nome do bairro']) !!}

                {!! Form::label('cidade', 'Cidade') !!}
                {!! Form::text('cidade', $paciente->cidade, ['placeholder' => 'Nome da cidade']) !!}

                {!! Form::label('uf', 'UF') !!}
                {!! Form::text('uf', $paciente->uf, ['placeholder' => 'Sigla UF', 'minlength' => 2, 'maxlength' => 2]) !!}
            </div>

            <h4>Observação:</h4>

            <div>
                {!! Form::textarea('obs', $paciente->obs, ['placeholder' => 'Obversações sobre o paciente']) !!}
            </div>
        </section>

        <footer>
            <section>
                <input type="submit" value="Salvar esse paciente" class="btn verde">
            </section>

            <span class="texto-vermelho">{{ $errors->first() }}</span>
        </footer>
    {!! Form::close() !!}

    <script>
        CKEDITOR.config.width = '100%';
        CKEDITOR.replace( 'obs' );
    </script>

@endsection