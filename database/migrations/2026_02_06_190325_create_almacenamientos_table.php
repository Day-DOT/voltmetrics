<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('almacenamiento', function (Blueprint $table) {
            $table->id('id_database'); // PK según diagrama
            $table->string('tipo_almacenamiento');
            $table->string('motor_bd');
            $table->string('frecuencia_respaldo');
            $table->string('capacidad');
            $table->string('estado');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('almacenamiento'); }
};