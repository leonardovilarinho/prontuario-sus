<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cabecalho extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'nome',
    	'local'
    ];
}
