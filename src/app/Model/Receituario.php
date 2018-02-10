<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Receituario extends Model
{
    
    protected $fillable = [
        'conteudo',
        'paciente_id',
        'autor_id',
        'created_at',
        'cabecalho_id',
        'controle'
    ];

    public function cabecalho()
    {
        return $this->belongsTo(Cabecalho::class, 'cabecalho_id', 'id');
    }

    public function autor()
    {
    	return $this->belongsTo(Usuario::class, 'autor_id', 'id');
    }

    public function medico()
    {
        return Medico::where('usuario_id', $this->autor_id)->first();
    }

    public function paciente()
    {
    	return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }
}
