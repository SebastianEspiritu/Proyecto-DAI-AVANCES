<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Medico;

class HomeController extends Controller
{
    public function index()
    {
        $especialidades = Especialidad::where('activo', true)->take(5)->get();
        $medicos = Medico::with(['user', 'especialidad'])
                        ->where('activo', true)
                        ->take(4)
                        ->get();

        return view('home', compact('especialidades', 'medicos'));
    }
}