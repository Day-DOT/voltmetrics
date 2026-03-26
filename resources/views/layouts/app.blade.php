<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Voltmetrics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fdf2f8; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        .pink-header { 
            background-color: #db2777; 
            color: white; 
            padding: 15px 25px; 
            border-radius: 0 0 20px 20px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Ajustes automáticos para Móvil */
        @media (max-width: 576px) {
            .pink-header { padding: 12px 15px; border-radius: 0; }
            .pink-header h2 { font-size: 1.2rem; }
            .container { padding-left: 10px; padding-right: 10px; }
        }
    </style>
</head>
<body>
    <div class="container-fluid container-md">
        <header class="pink-header">
            <h2 class="m-0 fw-bold">VOLTMETRICS</h2>
            <a href="{{ route('logout') }}" class="btn btn-light btn-sm fw-bold" style="color: #db2777;">
                Cerrar Sesión
            </a>
        </header>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>