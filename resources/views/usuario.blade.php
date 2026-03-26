<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Voltmetrics - Mi Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Diseño Rosa Voltmetrics */
        body { background-color: #fff0f5; font-family: 'Segoe UI', sans-serif; padding: 20px; }
        .container { max-width: 1000px; margin: auto; margin-top: 30px; }
        h1 { color: #db2777; text-align: center; margin-bottom: 30px; font-weight: bold; }
        
        .card { 
            background: white; 
            border-radius: 15px; 
            padding: 20px; 
            margin-bottom: 20px; 
            border: none; 
            box-shadow: 0 4px 6px rgba(219, 39, 119, 0.1); 
        }
        
        h3 { color: #be185d; border-bottom: 2px solid #fbcfe8; padding-bottom: 10px; margin-top: 0; }
        
        .graficas-grid { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px; }
        .chart-box { 
            flex: 1; 
            min-width: 400px; 
            background: white; 
            padding: 20px; 
            border-radius: 15px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.05); 
        }

        .btn-logout { 
            background-color: #f472b6; 
            color: white; 
            border-radius: 20px; 
            padding: 10px 25px; 
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-logout:hover { background-color: #db2777; color: white; }
        .text-center { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Panel de Consumo Energético</h1>

    <div class="card">
        <h3>Mi Perfil</h3>
        <p><strong>Nombre:</strong> {{ $perfil->nombre }} {{ $perfil->apellido }}</p>
        <p><strong>Correo:</strong> {{ $perfil->correo_electronico }}</p>
        <p><strong>Rol en Sistema:</strong> <span style="color: #db2777; font-weight: bold;">{{ strtoupper($perfil->rol) }}</span></p>
    </div>

    <div class="card">
        <h3>Consumo Total Registrado</h3>
        <p style="font-size: 32px; font-weight: bold; color: #be185d; margin: 0;">
            {{ number_format($total, 2) }} W
        </p>
    </div>

    <div class="graficas-grid">
        <div class="chart-box">
            <h4 style="text-align: center; color: #be185d;">Consumo por Hora (Hoy)</h4>
            <canvas id="graficaHora"></canvas>
        </div>
        
        <div class="chart-box">
            <h4 style="text-align: center; color: #be185d;">Gasto Semanal (7 días)</h4>
            <canvas id="graficaSemana"></canvas>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('logout') }}" class="btn-logout">Cerrar Sesión</a>
    </div>
</div>

<script>
    // Gráfica de Línea (Rosa Fuerte)
    const ctxHora = document.getElementById('graficaHora').getContext('2d');
    new Chart(ctxHora, {
        type: 'line',
        data: {
            labels: {!! json_encode($datosHora->pluck('hora')->map(fn($h) => $h.":00")) !!},
            datasets: [{
                label: 'Watts',
                data: {!! json_encode($datosHora->pluck('total')) !!},
                borderColor: '#db2777',
                backgroundColor: 'rgba(219, 39, 119, 0.1)',
                fill: true,
                tension: 0.4
            }]
        }
    });

    // Gráfica de Barras (Rosa Pastel)
    const ctxSemana = document.getElementById('graficaSemana').getContext('2d');
    new Chart(ctxSemana, {
        type: 'bar',
        data: {
            labels: {!! json_encode($datosSemana->pluck('fecha')) !!},
            datasets: [{
                label: 'Watts Acumulados',
                data: {!! json_encode($datosSemana->pluck('total')) !!},
                backgroundColor: '#f472b6',
                borderRadius: 5
            }]
        }
    });
</script>

</body>
</html>