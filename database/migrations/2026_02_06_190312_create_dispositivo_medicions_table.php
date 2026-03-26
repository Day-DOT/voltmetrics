<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('dispositivo_medicion', function (Blueprint $table) {
            $table->id('id_dispositivo');
            $table->string('codigo_dispositivo')->unique();
            $table->string('tipo_sensor');
            $table->string('microcontrolador');
            $table->string('rango_medicion');
            $table->string('unidad_medida');
            $table->string('estado');
            $table->dateTime('fecha_instalacion');
            $table->foreignId('id_area_FK')->constrained('area', 'id_area')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('dispositivo_medicion'); }
};