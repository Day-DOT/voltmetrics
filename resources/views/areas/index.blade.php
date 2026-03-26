@extends('layouts.app')

@section('content')
<h2><i class="fas fa-map-marker-alt me-2"></i> Áreas de Monitoreo</h2>
<div class="list-group mt-4">
    @foreach($areas as $area)
    <div class="list-group-item list-group-item-action d-flex justify-content-between">
        <div>
            <h5 class="mb-1">{{ $area->nombre_area }}</h5>
            <small>{{ $area->descripcion }}</small>
        </div>
        <span class="text-primary">ID Inst: {{ $area->id_institucion_FK }}</span>
    </div>
    @endforeach
</div>
@endsection