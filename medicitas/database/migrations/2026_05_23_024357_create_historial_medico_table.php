<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_medico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->constrained()->onDelete('cascade');
            $table->foreignId('paciente_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('medico_id')->constrained()->onDelete('cascade');
            $table->text('diagnostico');
            $table->text('tratamiento');
            $table->text('receta_medica')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_medico');
    }
};