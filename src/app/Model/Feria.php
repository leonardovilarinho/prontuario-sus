<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feria extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'data', 'dias', 'medico_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'medico_id', 'usuario_id');
    }
}
