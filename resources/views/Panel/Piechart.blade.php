@extends('layouts.navigation')
@extends('layouts.navbar')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique Donut</title>

    <!-- Inclure Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .chart-container {
            width: 400px;
            height: 400px;
            margin: 50px auto;
        }

        canvas {
            width: 100% !important;
            height: 100% !important;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <canvas id="monGraphiqueDonut"></canvas>
    </div>

    <script>
        // Récupérer le contexte du canvas pour dessiner le graphique
        var ctx = document.getElementById('monGraphiqueDonut').getContext('2d');

        // Créer le graphique donut
        var monGraphiqueDonut = new Chart(ctx, {
            type: 'doughnut', // Type de graphique (donut)
            data: {
                labels: ['Aliments', 'Transport', 'Loisirs', 'Santé', 'Autres'], // Catégories
                datasets: [{
                    data: [25, 20, 15, 10, 30], // Données pour chaque catégorie
                    backgroundColor: [
                        '#FF6384', // Rouge
                        '#36A2EB', // Bleu
                        '#FFCE56', // Jaune
                        '#4BC0C0', // Vert
                        '#9966FF'  // Violet
                    ],
                    borderColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF'
                    ],
                    borderWidth: 1 // Largeur des bordures
                }]
            },
            options: {
                responsive: true, // Graphique adaptatif
                cutout: '50%', // Taille du trou au centre
                plugins: {
                    legend: {
                        display: true, // Affiche la légende
                        position: 'bottom' // Position de la légende
                    }
                }
            }
        });
    </script>
</body>
</html>
@endsection
