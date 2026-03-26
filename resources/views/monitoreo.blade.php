@extends('layouts.app')

@section('content')
<div class="card p-3 p-md-4 shadow-sm" style="border: none; border-radius: 15px; background: white;">
    <h3 class="mb-4" style="color: #be185d; font-weight: bold;">Panel Administrativo</h3>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr style="background-color: #f472b6; color: white;">
                    <th style="border-radius: 10px 0 0 0; color: white !important;">Usuario</th>
                    <th style="color: white !important;">Consumo</th>
                    <th style="border-radius: 0 10px 0 0; color: white !important; text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $u)
                @php
                    $limite = 10000; 
                    $p = ($u->energia_total / $limite) * 100;
                    $c = ($p < 40) ? '#fbcfe8' : (($p < 80) ? '#f472b6' : '#be185d');
                @endphp
                <tr>
                    <td style="min-width: 150px;">
                        <div class="fw-bold" style="color: #880e4f;">{{ $u->nombre }}</div>
                        <div class="text-muted small">{{ $u->correo_electronico }}</div>
                    </td>
                    <td style="min-width: 180px;">
                        <div style="font-weight: bold; color: {{ $c }}; margin-bottom: 5px;">
                            {{ number_format($u->energia_total, 2) }} W
                        </div>
                        <div style="width: 100%; background: #fce4ec; border-radius: 10px; height: 8px; overflow: hidden;">
                            <div style="width: {{ $p > 100 ? 100 : $p }}%; background-color: {{ $c }}; height: 100%;"></div>
                        </div>
                    </td>
                    <td style="min-width: 210px; text-align: center;">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.verUsuario', $u->id_usuario) }}" class="btn btn-sm" style="background-color: #db2777; color: white;">Gráficas</a>
                            <a href="{{ route('usuario.edit', $u->id_usuario) }}" class="btn btn-sm" style="background-color: #f472b6; color: white;">Editar</a>
                            
                            <form action="{{ route('usuario.destroy', $u->id_usuario) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro?')">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection