<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\EspecialidadController;
use App\Http\Controllers\Admin\ConsultorioController;
use App\Http\Controllers\Admin\MedicoController;
use App\Http\Controllers\Admin\CitaAdminController;
use App\Http\Controllers\Admin\HistorialAdminController;
use App\Http\Controllers\Paciente\CitaController;
use App\Http\Controllers\Paciente\HistorialController;
use App\Http\Controllers\Medico\CitaMedicoController;
use App\Http\Controllers\Medico\HistorialMedicoController;

// Página principal pública
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas autenticadas
Route::middleware(['auth'])->group(function () {

    // Dashboard según rol
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->esAdmin()) return redirect()->route('admin.dashboard');
        if ($user->esMedico()) return redirect()->route('medico.citas.index');
        return redirect()->route('paciente.citas.index');
    })->name('dashboard');

    // ── ADMIN ──
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () {
    if (!auth()->user()->esAdmin()) abort(403);
    
    $totalMedicos = \App\Models\Medico::count();
    $totalPacientes = \App\Models\User::where('rol', 'paciente')->count();
    $citasHoy = \App\Models\Cita::whereDate('fecha', today())->count();
    $totalEspecialidades = \App\Models\Especialidad::count();
    
    return view('admin.dashboard', compact('totalMedicos', 'totalPacientes', 'citasHoy', 'totalEspecialidades'));
})->name('dashboard');

        Route::resource('especialidades', EspecialidadController::class);
        Route::resource('consultorios', ConsultorioController::class);
        Route::resource('medicos', MedicoController::class);
        Route::resource('citas', CitaAdminController::class);
        Route::get('historial', [HistorialAdminController::class, 'index'])->name('historial.index');
        Route::get('historial/{historial}', [HistorialAdminController::class, 'show'])->name('historial.show');
    });

    // ── PACIENTE ──
    Route::prefix('paciente')->name('paciente.')->group(function () {
        Route::resource('citas', CitaController::class);
        Route::get('historial', [HistorialController::class, 'index'])->name('historial.index');
        Route::get('historial/{historial}', [HistorialController::class, 'show'])->name('historial.show');
    });

    // ── MÉDICO ──
    Route::prefix('medico')->name('medico.')->group(function () {
        Route::resource('citas', CitaMedicoController::class);
        Route::get('citas/{cita}/atender', [HistorialMedicoController::class, 'create'])->name('citas.atender');
        Route::post('citas/{cita}/atender', [HistorialMedicoController::class, 'store'])->name('citas.atender.store');
        Route::get('historial', [HistorialMedicoController::class, 'index'])->name('historial.index');
    });
});

require __DIR__.'/auth.php';