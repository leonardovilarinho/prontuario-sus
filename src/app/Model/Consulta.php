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
    ];

    public function medico()
    {
    	return $this->belongsTo(Medico::class, 'medico_id', 'usuario_id');
    }

    public function paciente()
    {
    	return $this->belongsTo(Medico::class, 'paciente_id', 'id');
    }
}
