<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('especialidad_id');
            $table->unsignedBigInteger('consultorio_id');
            $table->string('cmp');
            $table->integer('anos_experiencia')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('especialidad_id')->references('id')->on('especialidades')->onDelete('cascade');
            $table->foreign('consultorio_id')->references('id')->on('consultorios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};