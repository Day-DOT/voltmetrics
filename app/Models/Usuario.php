<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario'; 

    public $timestamps = false;

    protected $fillable = ['nombre', 'correo', 'password', 'area_id'];
}