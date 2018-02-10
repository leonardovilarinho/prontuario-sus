<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    public $timestamps = false;
	public $table = 'permissoes';

    protected $fillable = [ 'medico_id', 'sec_id' ];

    public function medico()
    {
        return $this->hasOne(Medico::class, 'medico_id', 'id');
    }

    public function secretario()
    {
        return $this->hasOne(Secretario::class, 'sec_id', 'id');
    }
}
