<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'conselho',
        'especialidade',
        'cargo',
        'telefone',
        'usuario_id',
    ];

    public function usuario()
    {
    	return $this->belongsTo(Usuario::class, 'usuario_id', 'id');
    }
}
