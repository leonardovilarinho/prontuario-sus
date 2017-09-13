<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo', 'medico_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'medico_id', 'usuario_id');
    }
}
