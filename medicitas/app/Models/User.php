<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'rol', 'dni', 'telefono'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function esAdmin(): bool
    {
        return $this->rol === 'admin';
    }

    public function esMedico(): bool
    {
        return $this->rol === 'medico';
    }

    public function esPaciente(): bool
    {
        return $this->rol === 'paciente';
    }

    public function medico()
    {
        return $this->hasOne(Medico::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'paciente_id');
    }

    public function historialMedico()
    {
        return $this->hasMany(HistorialMedico::class, 'paciente_id');
    }
}