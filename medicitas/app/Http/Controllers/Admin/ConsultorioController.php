<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultorio;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{
    public function index()
    {
        if (!auth()->user()->esAdmin()) abort(403);
        $consultorios = Consultorio::orderBy('nombre')->paginate(10);
        return view('admin.consultorios.index', compact('consultorios'));
    }

    public function create()
    {
        if (!auth()->user()->esAdmin()) abort(403);
        return view('admin.consultorios.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->esAdmin()) abort(403);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'piso' => 'nullable|string|max:50',
        ]);
        Consultorio::create($request->all());
        return redirect()->route('admin.consultorios.index')->with('success', 'Consultorio creado correctamente.');
    }

    public function edit(Consultorio $consultorio)
    {
        if (!auth()->user()->esAdmin()) abort(403);
        return view('admin.consultorios.edit', compact('consultorio'));
    }

    public function update(Request $request, Consultorio $consultorio)
    {
        if (!auth()->user()->esAdmin()) abort(403);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'piso' => 'nullable|string|max:50',
        ]);
        $consultorio->update($request->all());
        return redirect()->route('admin.consultorios.index')->with('success', 'Consultorio actualizado correctamente.');
    }

    public function destroy(Consultorio $consultorio)
    {
        if (!auth()->user()->esAdmin()) abort(403);
        $consultorio->delete();
        return redirect()->route('admin.consultorios.index')->with('success', 'Consultorio eliminado correctamente.');
    }
}