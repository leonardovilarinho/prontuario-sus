<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NaoMedico extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'conselho',
        'especialidade',
        'cargo',
        'telefone',
        'usuario_id',
        'historico',
        'ferias',
        'cabecalho_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id');
    }

    public function carga_horaria()
    {
        return $this->hasOne(CargaHoraria::class, 'medico_id', 'usuario_id');
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'usuario_id', 'usuario_id');
    }

    public function cabecalho()
    {
        return $this->belongsTo(Cabecalho::class, 'cabecalho_id', 'id');
    }
}
