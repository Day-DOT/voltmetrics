<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo_electronico')->unique();
            $table->string('contraseña');
            $table->string('rol');
            $table->string('estado');
            $table->dateTime('fecha_registro');
            $table->foreignId('id_institucion_FK')->constrained('institucion', 'id_institucion');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('usuario'); }
};