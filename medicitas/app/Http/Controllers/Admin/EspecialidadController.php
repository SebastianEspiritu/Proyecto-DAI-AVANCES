<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index()
    {
        if (!auth()->user()->esAdmin()) abort(403);
        $especialidades = Especialidad::orderBy('nombre')->paginate(10);
        return view('admin.especialidades.index', compact('especialidades'));
    }

    public function create()
    {
        if (!auth()->user()->esAdmin()) abort(403);
        return view('admin.especialidades.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->esAdmin()) abort(403);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);
        Especialidad::create($request->all());
        return redirect()->route('admin.especialidades.index')->with('success', 'Especialidad creada correctamente.');
    }

    public function edit(Especialidad $especialidad)
    {
        if (!auth()->user()->esAdmin()) abort(403);
        return view('admin.especialidades.edit', compact('especialidad'));
    }

    public function update(Request $request, Especialidad $especialidad)
    {
        if (!auth()->user()->esAdmin()) abort(403);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);
        $especialidad->update($request->all());
        return redirect()->route('admin.especialidades.index')->with('success', 'Especialidad actualizada correctamente.');
    }

    public function destroy(Especialidad $especialidad)
    {
        if (!auth()->user()->esAdmin()) abort(403);
        $especialidad->delete();
        return redirect()->route('admin.especialidades.index')->with('success', 'Especialidad eliminada correctamente.');
    }
}