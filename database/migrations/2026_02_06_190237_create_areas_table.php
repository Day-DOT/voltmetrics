<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('area', function (Blueprint $table) {
            $table->id('id_area'); // PK según diagrama
            $table->string('nombre_area');
            $table->text('descripcion')->nullable();
            $table->foreignId('id_institucion_FK')->constrained('institucion', 'id_institucion')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('area'); }
};