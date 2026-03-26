<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model {
    protected $table = 'institucion'; // Forzar singular
    protected $primaryKey = 'id_institucion'; // Forzar PK personalizada
    protected $fillable = ['nombre', 'tipo', 'direccion', 'ciudad', 'pais', 'fecha_registro'];
}