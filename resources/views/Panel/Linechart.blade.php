@extends('layouts.navigation')
@extends('layouts.navbar')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique à Barres Futuriste</title>

    <!-- Inclure Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background: radial-gradient(circle, #0f2027, #203a43, #2c5364);
            color: #e4e4e4;
            font-family: 'Roboto', sans-serif;
            margin: 0;
        }

        .chart-container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        canvas {
            display: block;
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <canvas id="myBarChart"></canvas>
    </div>

    <script>
        // Configuration du graphique à barres
        const ctx = document.getElementById('myBarChart').getContext('2d');
        const myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin'],
                datasets: [{
                    label: 'Utilisateurs Actifs',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(0, 128, 255, 0.7)',
                        'rgba(0, 104, 204, 0.7)',
                        'rgba(0, 79, 153, 0.7)',
                        'rgba(0, 56, 102, 0.7)',
                        'rgba(0, 33, 51, 0.7)',
                        'rgba(0, 12, 25, 0.7)'
                    ],
                    borderColor: 'rgba(0, 128, 255, 1)',
                    borderWidth: 2,
                    hoverBackgroundColor: 'rgba(255, 255, 0, 0.8)',
                    hoverBorderColor: 'rgba(255, 255, 0, 1)',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#e4e4e4',
                            font: {
                                size: 16,
                            }
                        }
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#e4e4e4',
                            font: {
                                size: 14,
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)',
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#e4e4e4',
                            font: {
                                size: 14,
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)',
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
@endsection
