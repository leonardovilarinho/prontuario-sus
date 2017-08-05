<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'horario',
        'obs',
        'status',
        'medico_id',
        'paciente_id',
        'atendida',
        'valor'
    ];

    public function medico()
    {
    	return $this->belongsTo(Usuario::class, 'medico_id', 'id');
    }

    public function paciente()
    {
    	return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }
}
