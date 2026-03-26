<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedicionController extends Controller 
{
    // --- VISTAS DE ACCESO ---
    public function loginView() {
        return view('login'); 
    }

    // --- REGISTRO DE USUARIOS ---
    public function storeUsuario(Request $request) {
        DB::table('usuario')->insert([
            'nombre' => $request->nombre,
            'apellido' => 'N/A',
            'correo_electronico' => $request->correo,
            'contraseña' => $request->password,
            'rol' => 'usuario',
            'estado' => '1',
            'id_institucion_FK' => 1, // ID por defecto según tu voltmetrics.sql
            'fecha_registro' => Carbon::now(),
        ]);
        return redirect()->route('login')->with('success', '¡Registro exitoso!');
    }

    // --- LOGICA DE LOGIN (ADMIN Y USUARIO) ---
    public function login(Request $request) {
        $correo = $request->correo;
        $password = $request->password;
        $rol_elegido = $request->rol_btn; 

        if ($rol_elegido == 'admin') {
            $user = DB::table('administrador')
                ->where('correo_electronico', $correo)
                ->where('contraseña', $password)
                ->first();
            $rol = 'admin';
        } else {
            $user = DB::table('usuario')
                ->where('correo_electronico', $correo)
                ->where('contraseña', $password)
                ->first();
            $rol = 'usuario';
        }

        if ($user) {
            session(['user' => $user, 'rol' => $rol]);
            return ($rol == 'admin') 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('usuario.dashboard');
        }
        return back()->with('error', 'Credenciales incorrectas');
    }

    // --- PANEL DE ADMINISTRADOR (MONITOREO) ---
    public function adminDashboard() {
        $usuarios = DB::table('usuario')->get();
        foreach ($usuarios as $u) {
            // Relación: usuario -> institucion -> area -> dispositivo -> medicion
            $u->energia_total = DB::table('medicion')
                ->join('dispositivo_medicion', 'medicion.id_dispositivo_FK', '=', 'dispositivo_medicion.id_dispositivo')
                ->join('area', 'dispositivo_medicion.id_area_FK', '=', 'area.id_area')
                ->where('area.id_institucion_FK', $u->id_institucion_FK)
                ->sum('medicion.potencia');
        }
        return view('monitoreo', compact('usuarios')); 
    }

    // --- PANEL DE USUARIO (CON GRÁFICAS) ---
    public function usuarioView() {
        $perfil = session('user');
        if (!$perfil) {
            return redirect()->route('login');
        }

        // 1. Consumo Total del usuario
        $total = DB::table('medicion')
            ->join('dispositivo_medicion', 'medicion.id_dispositivo_FK', '=', 'dispositivo_medicion.id_dispositivo')
            ->join('area', 'dispositivo_medicion.id_area_FK', '=', 'area.id_area')
            ->where('area.id_institucion_FK', $perfil->id_institucion_FK)
            ->sum('medicion.potencia');

        // 2. Datos para Gráfica por Hora (Hoy)
        $datosHora = DB::table('medicion')
            ->join('dispositivo_medicion', 'medicion.id_dispositivo_FK', '=', 'dispositivo_medicion.id_dispositivo')
            ->join('area', 'dispositivo_medicion.id_area_FK', '=', 'area.id_area')
            ->where('area.id_institucion_FK', $perfil->id_institucion_FK)
            ->whereDate('medicion.created_at', Carbon::today())
            ->select(DB::raw('HOUR(medicion.created_at) as hora'), DB::raw('SUM(potencia) as total'))
            ->groupBy('hora')
            ->orderBy('hora', 'asc')
            ->get();

        // 3. Datos para Gráfica Semanal
        $datosSemana = DB::table('medicion')
            ->join('dispositivo_medicion', 'medicion.id_dispositivo_FK', '=', 'dispositivo_medicion.id_dispositivo')
            ->join('area', 'dispositivo_medicion.id_area_FK', '=', 'area.id_area')
            ->where('area.id_institucion_FK', $perfil->id_institucion_FK)
            ->where('medicion.created_at', '>=', Carbon::now()->subDays(7))
            ->select(DB::raw('DATE(medicion.created_at) as fecha'), DB::raw('SUM(potencia) as total'))
            ->groupBy('fecha')
            ->orderBy('fecha', 'asc')
            ->get();

        return view('usuario', compact('perfil', 'total', 'datosHora', 'datosSemana'));
    }

    // --- VER GRÁFICA INDIVIDUAL (Desde Admin) ---
    public function adminVerUsuario($id) {
        $usuario = DB::table('usuario')->where('id_usuario', $id)->first();
        $mediciones = DB::table('medicion')
            ->join('dispositivo_medicion', 'medicion.id_dispositivo_FK', '=', 'dispositivo_medicion.id_dispositivo')
            ->join('area', 'dispositivo_medicion.id_area_FK', '=', 'area.id_area')
            ->where('area.id_institucion_FK', $usuario->id_institucion_FK)
            ->select('medicion.potencia', 'medicion.created_at')
            ->orderBy('medicion.created_at', 'asc')
            ->get();

        return view('admin_ver_usuario', compact('usuario', 'mediciones'));
    }

    // --- CRUD: EDITAR Y ELIMINAR ---
    public function edit($id) {
        $usuario = DB::table('usuario')->where('id_usuario', $id)->first();
        return view('editar_usuario', compact('usuario'));
    }

    public function update(Request $request, $id) {
        DB::table('usuario')->where('id_usuario', $id)->update([
            'nombre' => $request->nombre,
            'correo_electronico' => $request->correo
        ]);
        return redirect()->route('admin.dashboard');
    }

    public function destroy($id) {
        DB::table('usuario')->where('id_usuario', $id)->delete();
        return back();
    }

    public function logout() {
        session()->forget(['user', 'rol']);
        return redirect()->route('login');
    }
}