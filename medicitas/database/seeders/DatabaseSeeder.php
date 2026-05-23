<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Especialidad;
use App\Models\Consultorio;
use App\Models\Medico;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@medicitas.com',
            'password' => Hash::make('password'),
            'rol' => 'admin',
        ]);

        // Especialidades
        $especialidades = [
            ['nombre' => 'Cardiología', 'descripcion' => 'Enfermedades del corazón', 'activo' => true],
            ['nombre' => 'Pediatría', 'descripcion' => 'Atención a niños', 'activo' => true],
            ['nombre' => 'Neurología', 'descripcion' => 'Enfermedades del sistema nervioso', 'activo' => true],
            ['nombre' => 'Traumatología', 'descripcion' => 'Lesiones y huesos', 'activo' => true],
            ['nombre' => 'Gastroenterología', 'descripcion' => 'Sistema digestivo', 'activo' => true],
        ];

        foreach ($especialidades as $esp) {
            Especialidad::create($esp);
        }

        // Consultorios
        $consultorios = [
            ['nombre' => 'Consultorio C-101', 'ubicacion' => 'Piso 1', 'piso' => '1', 'activo' => true],
            ['nombre' => 'Consultorio C-201', 'ubicacion' => 'Piso 2', 'piso' => '2', 'activo' => true],
            ['nombre' => 'Consultorio C-301', 'ubicacion' => 'Piso 3', 'piso' => '3', 'activo' => true],
        ];

        foreach ($consultorios as $con) {
            Consultorio::create($con);
        }

        // Médicos
        $medicosData = [
            ['name' => 'Dr. García Sánchez', 'email' => 'garcia@medicitas.com', 'especialidad_id' => 1, 'consultorio_id' => 2, 'cmp' => '45231', 'anos' => 10],
            ['name' => 'Dr. Torres Mendoza', 'email' => 'torres@medicitas.com', 'especialidad_id' => 3, 'consultorio_id' => 1, 'cmp' => '45232', 'anos' => 12],
            ['name' => 'Dr. López Ramírez', 'email' => 'lopez@medicitas.com', 'especialidad_id' => 2, 'consultorio_id' => 3, 'cmp' => '45233', 'anos' => 8],
            ['name' => 'Dra. Pérez Gómez', 'email' => 'perez@medicitas.com', 'especialidad_id' => 4, 'consultorio_id' => 1, 'cmp' => '45234', 'anos' => 9],
        ];

        foreach ($medicosData as $m) {
            $user = User::create([
                'name' => $m['name'],
                'email' => $m['email'],
                'password' => Hash::make('password'),
                'rol' => 'medico',
            ]);

            Medico::create([
                'user_id' => $user->id,
                'especialidad_id' => $m['especialidad_id'],
                'consultorio_id' => $m['consultorio_id'],
                'cmp' => $m['cmp'],
                'anos_experiencia' => $m['anos'],
                'activo' => true,
            ]);
        }

        // Paciente de prueba
        User::create([
            'name' => 'Pedro García',
            'email' => 'pedro@email.com',
            'password' => Hash::make('password'),
            'rol' => 'paciente',
            'dni' => '45678901',
            'telefono' => '987654321',
        ]);
    }
}