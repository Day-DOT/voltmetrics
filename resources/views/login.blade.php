<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Voltmetrics - Acceso</title>
    <style>
        body { font-family: sans-serif; padding: 40px; background-color: #fdf2f8; }
        .container { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(219,39,119,0.15); }
        h1, h2 { color: #9d174d; font-weight: bold; text-align: center; }
        label { display: block; margin-top: 15px; font-weight: bold; color: #4a044e; }
        input { width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #fbcfe8; border-radius: 6px; box-sizing: border-box; }
        input:focus { border-color: #db2777; outline: none; box-shadow: 0 0 5px rgba(219,39,119,0.2); }
        
        .btn-admin { background: #9d174d; color: white; border: none; padding: 12px; width: 100%; cursor: pointer; font-size: 16px; margin-top: 15px; text-transform: uppercase; border-radius: 6px; font-weight: bold; }
        .btn-user { background: #db2777; color: white; border: none; padding: 12px; width: 100%; cursor: pointer; font-size: 16px; margin-top: 10px; text-transform: uppercase; border-radius: 6px; font-weight: bold; }
        .btn-registrar { background: #be185d; color: white; border: none; padding: 15px; width: 100%; cursor: pointer; font-size: 18px; margin-top: 20px; text-transform: uppercase; border-radius: 6px; font-weight: bold; }
        
        .btn-admin:hover { background: #701037; }
        .btn-user:hover { background: #be185d; }
        .btn-registrar:hover { background: #9d174d; }
        
        .error { color: #e11d48; font-weight: bold; text-align: center; padding: 10px; background: #fff1f2; border-radius: 5px; }
        .success { color: #047857; font-weight: bold; text-align: center; padding: 10px; background: #ecfdf5; border-radius: 5px; }
        hr { margin: 40px 0; border: 0; border-top: 2px solid #fce4ec; }
    </style>
</head>
<body>

<div class="container">
    <h1>Voltmetrics - Acceso</h1>
    
    @if(session('error')) <p class="error">{{ session('error') }}</p> @endif
    
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <label>Correo:</label>
        <input type="email" name="correo" required>
        
        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <div style="margin-top: 20px;">
            <button type="submit" name="rol_btn" value="admin" class="btn-admin">
                Entrar como Administrador
            </button>
            <button type="submit" name="rol_btn" value="usuario" class="btn-user">
                Entrar como Usuario
            </button>
        </div>
    </form>

    <hr>

    <h2>¿Eres nuevo? Regístrate aquí</h2>
    @if(session('success')) <p class="success">{{ session('success') }}</p> @endif

    <form action="{{ route('registro.post') }}" method="POST">
        @csrf
        <label>Nombre Completo</label>
        <input type="text" name="nombre" placeholder="Tu nombre" required>
        
        <label>Correo Electrónico</label>
        <input type="email" name="correo" placeholder="ejemplo@correo.com" required>
        
        <label>Contraseña</label>
        <input type="password" name="password" placeholder="Crea una contraseña" required>
        
        <button type="submit" class="btn-registrar">CREAR MI CUENTA</button>
    </form>
</div>

</body>
</html>