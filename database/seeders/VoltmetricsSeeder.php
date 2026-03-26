<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institucion;
use App\Models\Area;

class VoltmetricsSeeder extends Seeder {
    public function run(): void {
        // Crear Institución
        $inst = Institucion::create([
            'nombre' => 'Sede Central Voltmetrics',
            'tipo' => 'Energía',
            'ciudad' => 'Mexico',
            'pais' => 'Mexico',
            'fecha_registro' => now()
        ]);

        // Crear Área asociada
        Area::create([
            'nombre_area' => 'Zona de Monitoreo A1',
            'id_institucion_FK' => $inst->id_institucion
        ]);
    }
}