<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CargaEnergiaSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // 1. Limpiamos todas las tablas
        DB::table('medicion')->truncate();
        DB::table('usuario')->truncate();
        DB::table('administrador')->truncate();

        // 2. Insertamos al Administrador
        DB::table('administrador')->insert([
            'nombre' => 'Admin Voltmetrics',
            'correo_electronico' => 'al222410870@gmail.com',
            'contraseña' => '123',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 3. Generamos 50 Usuarios
        for ($i = 1; $i <= 50; $i++) {
            DB::table('usuario')->insert([
                'nombre' => 'Usuario_' . $i,
                'apellido' => 'Apellido_' . $i,
                'correo_electronico' => 'usuario' . $i . '@voltmetrics.com',
                'contraseña' => '123',
                'rol' => 'usuario',
                'estado' => 1,
                'fecha_registro' => now(),
                'id_institucion_FK' => 1
            ]);
        }

        // 4. Generamos 200 registros de medición
        for ($i = 0; $i < 200; $i++) {
            $fechaAleatoria = Carbon::now()->subDays(rand(0, 7))->subHours(rand(0, 23));
            $potenciaSorteada = rand(50, 600);
            $voltajeSorteado = rand(110, 125);

            DB::table('medicion')->insert([
                'potencia' => $potenciaSorteada,
                'voltaje' => $voltajeSorteado,
                'corriente' => round($potenciaSorteada / $voltajeSorteado, 2),
                'consumo_energia' => round($potenciaSorteada / 1000, 4),
                'fecha_hora' => $fechaAleatoria,
                'id_dispositivo_FK' => 1,
                'id_almacenamiento_FK' => 1
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}