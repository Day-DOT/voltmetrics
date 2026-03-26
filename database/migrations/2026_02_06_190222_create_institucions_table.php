<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('institucion', function (Blueprint $table) {
            $table->id('id_institucion'); // PK según diagrama
            $table->string('nombre');
            $table->string('tipo')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('pais')->nullable();
            $table->timestamp('fecha_registro')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('institucion'); }
};