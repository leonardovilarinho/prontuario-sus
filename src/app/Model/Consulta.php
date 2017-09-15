<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'horario',
        'obs',
        'status',
        'usuario_id',
        'paciente_id',
        'atendida',
        'valor'
    ];

    public function usuario()
    {
    	return $this->belongsTo(Usuario::class, 'usuario_id', 'id');
    }

    public function medico()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id');
    }

    public function paciente()
    {
    	return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }
}
