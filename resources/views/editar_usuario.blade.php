<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fdf2f8; display: flex; justify-content: center; padding: 50px; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(219,39,119,0.15); width: 400px; border: 1px solid #fbcfe8; }
        h2 { color: #9d174d; text-align: center; margin-bottom: 25px; }
        label { font-weight: bold; color: #4a044e; display: block; margin-top: 10px; }
        input { width: 100%; padding: 12px; margin: 8px 0 15px 0; border: 1px solid #fbcfe8; border-radius: 6px; box-sizing: border-box; }
        input:focus { border-color: #db2777; outline: none; box-shadow: 0 0 5px rgba(219,39,119,0.2); }
        button { width: 100%; padding: 12px; background: #db2777; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; text-transform: uppercase; }
        button:hover { background: #be185d; }
        .btn-cancelar { display: block; text-align: center; margin-top: 15px; color: #9d174d; text-decoration: none; font-size: 0.9em; }
        .btn-cancelar:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="card">
    <h2>Editar Usuario</h2>
    <form action="{{ route('usuario.update', $usuario->id_usuario) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $usuario->nombre }}" required>
        
        <label>Correo:</label>
        <input type="email" name="correo" value="{{ $usuario->correo_electronico }}" required>
        
        <label>Contraseña:</label>
        <input type="text" name="password" value="{{ $usuario->contraseña }}" required>
        
        <button type="submit">Guardar Cambios</button>
    </form>
    <a href="{{ route('admin.dashboard') }}" class="btn-cancelar">Cancelar</a>
</div>
</body>
</html>