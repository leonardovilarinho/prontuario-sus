<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Prescricao extends Model
{
    protected $fillable = [
        'nome',
        'paciente_id',
        'autor_id'
    ];

    public function autor()
    {
    	return $this->belongsTo(Usuario::class, 'autor_id', 'id');
    }

    public function paciente()
    {
    	return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }

    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class, 'pescricao_medicacaos', 'prescricao_id', 'medicacao_id')
        ->withPivot(['dose', 'intervalo', 'tempo', 'id']);
    }

    public function equipamentos()
    {
        return $this->belongsToMany(Equipamento::class, 'pescricao_equipamentos', 'prescricao_id', 'equipamento_id')
        ->withPivot(['id']);
    }
}
