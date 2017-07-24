<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
    	'nome',
    	'prontuario',
    	'leito',
    	'nascimento',
    	'convenio',
    	'num_convenio',
    	'sexo',
    	'civil',
    	'cor',
    	'naturalidade',
    	'grau',
    	'cpf',
    	'profissao',
    	'email',
    	'telefone',
    	'endereco',
    	'bairro',
    	'cidade',
    	'cep',
    	'uf',
    	'obs'
    ];
}
