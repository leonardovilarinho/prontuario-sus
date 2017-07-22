<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $fillable = [
    	'id',
    	'nome',
    	'email',
    	'cpf',
    	'nascimento',
    	'senha',
    ];

    protected $hidden = [
    	'senha',
        'remember_token'
    ];

    public function administrador()
    {
    	return $this->hasOne(Administrador::class, 'usuario_id', 'id');
    }

    public function tipo()
    {
        if($this->administrador)
            return'ADMINISTRADOR';

        return 'NÃO ENCONTRADO';
    }
}
