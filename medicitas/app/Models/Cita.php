<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'paciente_id', 'medico_id', 'fecha', 'hora', 'motivo_consulta', 'estado'
    ];

    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente_id');
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function historialMedico()
    {
        return $this->hasOne(HistorialMedico::class);
    }
}