<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'nome' ];
}
