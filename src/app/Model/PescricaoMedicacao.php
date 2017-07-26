<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PescricaoMedicacao extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'dose',
    	'intervalo',
    	'tempo',
    	'prescricao_id',
    	'medicacao_id',
    ];

    public function medicamento()
    {
    	return $this->belongsTo(Medicamento::class, 'medicacao_id', 'id');
    }

    public function prescricao()
    {
    	return $this->belongsTo(Prescricao::class, 'prescricao_id', 'id');
    }
}
