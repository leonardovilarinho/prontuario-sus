<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    public $timestamps = false;
	public $table = 'administradores';
	protected $primaryKey = 'usuario_id';

    protected $fillable = [ 'usuario_id' ];

    public function usuario()
    {
    	return $this->belongsTo(Usuario::class, 'usuario_id', 'id');
    }
}
