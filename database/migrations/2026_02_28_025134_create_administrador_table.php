<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('administrador', function (Blueprint $table) {
            $table->id(); // El ID automático (Primary Key)
            $table->string('nombre');
            $table->string('correo_electronico')->unique(); // Correo único para evitar duplicados
            $table->string('contraseña'); // Usamos la ñ como en tus otras tablas
            $table->timestamps(); // Crea las columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrador');
    }
};