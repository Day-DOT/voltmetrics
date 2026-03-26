<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $datos = $request->all();
        $datos['contraseña'] = Hash::make($request->contraseña);
        $usuario = Usuario::create($datos);
        return response()->json($usuario, 201);
    }
}