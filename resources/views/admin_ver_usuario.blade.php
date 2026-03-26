<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Voltmetrics - Gráficas Rosa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background-color: #fff0f5; font-family: 'Segoe UI', sans-serif; }
        .card { border-radius: 20px; border: none; }
        .card-header { background-color: #ff69b4 !important; color: white; border-radius: 20px 20px 0 0 !important; }
        .btn-rosa { background-color: #ff1493; color: white; border-radius: 25px; padding: 8px 25px; border: none; }
        .btn-rosa:hover { background-color: #c71585; color: white; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center p-3">
                <h4 class="mb-0">Monitoreo: {{ $usuario->nombre }}</h4>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm">Regresar</a>
            </div>
            <div class="card-body p-4">
                <div style="height: 400px;">
                    <canvas id="graficaRosa"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('graficaRosa').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($mediciones->pluck('created_at')),
                datasets: [{
                    label: 'Consumo (Watts)',
                    data: @json($mediciones->pluck('potencia')),
                    borderColor: '#ff1493',
                    backgroundColor: 'rgba(255, 105, 180, 0.2)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, grid: { color: '#ffd1dc' } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>