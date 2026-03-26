@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-university me-2"></i> Instituciones</h2>
    <button class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Institución</button>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Ubicación</th>
                    <th>País</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($instituciones as $inst)
                <tr>
                    <td>{{ $inst->nombre }}</td>
                    <td>{{ $inst->tipo }}</td>
                    <td>{{ $inst->ciudad }}, {{ $inst->direccion }}</td>
                    <td>{{ $inst->pais }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection