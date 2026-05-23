<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    protected $fillable = ['nombre', 'ubicacion', 'piso', 'activo'];

    public function medicos()
    {
        return $this->hasMany(Medico::class);
    }
}