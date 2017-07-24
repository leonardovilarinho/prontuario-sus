<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Secretario extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'cargo',
        'telefone',
        'usuario_id',
    ];

    public function usuario()
    {
    	return $this->belongsTo(Usuario::class, 'usuario_id', 'id');
    }
}
