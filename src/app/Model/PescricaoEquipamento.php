<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PescricaoEquipamento extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'prescricao_id',
    	'equipamento_id',
    ];

    public function equipamento()
    {
    	return $this->belongsTo(Equipamento::class, 'equipamento_id', 'id');
    }

    public function prescricao()
    {
    	return $this->belongsTo(Prescricao::class, 'prescricao_id', 'id');
    }
}
