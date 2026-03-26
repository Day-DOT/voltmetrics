<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedicionSeeder extends Seeder
{
    public function run()
    {
        // Limpiamos la tabla para no duplicar datos viejos (opcional)
        // DB::table('medicion')->truncate();

        $hoy = Carbon::today();

        // Creamos registros para diferentes horas del día de hoy
        $datos = [
            ['potencia' => 150, 'voltaje' => 110, 'fecha_hora' => $hoy->copy()->setHour(8)],
            ['potencia' => 220, 'voltaje' => 112, 'fecha_hora' => $hoy->copy()->setHour(10)],
            ['potencia' => 450, 'voltaje' => 115, 'fecha_hora' => $hoy->copy()->setHour(12)],
            ['potencia' => 300, 'voltaje' => 110, 'fecha_hora' => $hoy->copy()->setHour(14)],
            ['potencia' => 500, 'voltaje' => 114, 'fecha_hora' => $hoy->copy()->setHour(16)],
            ['potencia' => 100, 'voltaje' => 111, 'fecha_hora' => $hoy->copy()->setHour(18)],
        ];

        foreach ($datos as $dato) {
            DB::table('medicion')->insert([
                'potencia' => $dato['potencia'],
                'voltaje' => $dato['voltaje'],
                'fecha_hora' => $dato['fecha_hora'],
                'id_usuario_FK' => 1, // Asegúrate de que el usuario con ID 1 exista
                'id_dispositivo_FK' => 1 // Asegúrate de que el dispositivo con ID 1 exista
            ]);
        }
    }
}