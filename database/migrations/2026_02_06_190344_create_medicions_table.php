<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('medicion', function (Blueprint $table) {
            $table->id('id_medicion');
            $table->float('corriente');
            $table->float('voltaje');
            $table->float('potencia');
            $table->float('consumo_energia');
            $table->dateTime('fecha_hora');
            $table->foreignId('id_dispositivo_FK')->constrained('dispositivo_medicion', 'id_dispositivo');
            $table->foreignId('id_almacenamiento_FK')->constrained('almacenamiento', 'id_database');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('medicion'); }
};