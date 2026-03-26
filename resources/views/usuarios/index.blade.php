@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2><i class="fas fa-users me-2"></i> Gestión de Usuarios</h2>
</div>

<div class="row">
    @foreach($usuarios as $user)
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-user-circle fa-3x mb-3 text-secondary"></i>
                <h5>{{ $user->nombre }} {{ $user->apellido }}</h5>
                <p class="text-muted">{{ $user->correo_electronico }}</p>
                <span class="badge bg-info">{{ $user->rol }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection