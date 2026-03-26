<?php

namespace App\Http\Controllers;

use App\Models\Institucion; // Importamos el modelo
use Illuminate\Http\Request;

class InstitucionController extends Controller
{
    public function index()
    {
        // Obtiene todas las instituciones de la tabla 'institucion'
        $instituciones = Institucion::all(); 
        return view('instituciones.index', compact('instituciones'));
    }
}