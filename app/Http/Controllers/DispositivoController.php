<?php

namespace App\Http\Controllers;

use App\Models\DispositivoMedicion;
use Illuminate\Http\Request;

class DispositivoController extends Controller
{
    public function index()
    {
        $dispositivos = DispositivoMedicion::all();
        return view('dispositivos.index', compact('dispositivos'));
    }

    public function store(Request $request)
    {
        $dispositivo = DispositivoMedicion::create($request->all());
        return response()->json($dispositivo, 201);
    }
}