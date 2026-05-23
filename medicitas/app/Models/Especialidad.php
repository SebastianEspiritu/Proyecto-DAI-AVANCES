<?php

namespace App\Models;

use App\Models\Medico;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';
    
    protected $fillable = ['nombre', 'descripcion', 'icono', 'activo'];

    public function medicos()
    {
        return $this->hasMany(Medico::class);
    }
}