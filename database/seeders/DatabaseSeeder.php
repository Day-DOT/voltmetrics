<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar llaves foráneas para limpiar tablas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('medicion')->truncate();
        DB::table('dispositivo_medicion')->truncate();
        DB::table('area')->truncate();
        DB::table('institucion')->truncate();
        DB::table('almacenamiento')->truncate();
        DB::table('administrador')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Crear Administrador
        DB::table('administrador')->insert([
            'nombre' => 'Admin Voltmetrics',
            'correo_electronico' => 'admin@gmail.com',
            'contraseña' => '123',
            'created_at' => now()
        ]);

        // 2. Crear Almacenamiento (necesario para la tabla medicion)
        $almId = DB::table('almacenamiento')->insertGetId([
            'tipo_almacenamiento' => 'Local',
            'motor_bd' => 'MySQL',
            'frecuencia_respaldo' => 'Diaria',
            'capacidad' => '10GB',
            'estado' => 'Activo',
            'created_at' => now()
        ]);

        // 3. Crear Institución (Corregido: columna 'nombre')
        $instId = DB::table('institucion')->insertGetId([
            'nombre' => 'UTVT Universidad',
            'created_at' => now()
        ]);

        // 4. Crear Áreas
        $areas = ['Laboratorio de IoT', 'Edificio de Docencia', 'Talleres'];
        foreach ($areas as $nArea) {
            $areaId = DB::table('area')->insertGetId([
                'nombre_area' => $nArea,
                'id_institucion_FK' => $instId,
                'created_at' => now()
            ]);

            // 5. Crear 1 Dispositivo por área
            $dispId = DB::table('dispositivo_medicion')->insertGetId([
                'codigo_dispositivo' => 'VOLT-'.rand(100,999),
                'tipo_sensor' => 'SCT-013',
                'microcontrolador' => 'ESP32',
                'rango_medicion' => '100A',
                'unidad_medida' => 'Watts',
                'estado' => 'Activo',
                'fecha_instalacion' => now(),
                'id_area_FK' => $areaId,
                'created_at' => now()
            ]);

            // 6. Generar 24 mediciones (una por hora para hoy)
            // Cada dispositivo tendrá datos de potencia distintos (aleatorios)
            for ($i = 0; $i < 24; $i++) {
                $potenciaAleatoria = rand(100, 800); // Entre 100 y 800 Watts
                DB::table('medicion')->insert([
                    'corriente' => $potenciaAleatoria / 120,
                    'voltaje' => 120,
                    'potencia' => $potenciaAleatoria,
                    'consumo_energia' => $potenciaAleatoria / 1000,
                    'fecha_hora' => Carbon::today()->addHours($i),
                    'id_dispositivo_FK' => $dispId,
                    'id_almacenamiento_FK' => $almId,
                    'created_at' => Carbon::today()->addHours($i),
                ]);
            }
        }

        // 7. Vincular a tus usuarios (Videl, Diego, Alana, etc.) a la institución 1
        // Esto asegura que al loguearse vean los datos generados arriba
        DB::table('usuario')->update(['id_institucion_FK' => $instId]);
    }
}