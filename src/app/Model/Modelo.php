<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'titulo',
    	'conteudo',
    	'medico_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'medico_id', 'usuario_id');
    }
}
