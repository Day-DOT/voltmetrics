<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::with('institucion')->get();
        return view('areas.index', compact('areas'));
    }

    public function store(Request $request)
    {
        $area = Area::create($request->all());
        return response()->json($area, 201);
    }
}