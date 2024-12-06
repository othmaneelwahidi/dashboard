@extends('layouts.navigation')
@extends('layouts.navbar')

@section('content')
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>

        <link rel="stylesheet" href="https://www.cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            .chart-container {
                width: 90%;
                /* Wider chart */
                max-width: 1000px;
                /* Bigger maximum size */
                height: 500px;
                /* Increased height */
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 0 30px rgba(169, 169, 169, 0.5);
                background: rgba(43, 43, 43, 0.95);
                margin-left: 20%;
                margin-top: 5%;
            }

            canvas {
                display: block;
            }

            .chart-container {
                width: 80%;
                margin: auto;
                padding-top: 50px;
            }

            .row {
                margin: 0;
                /* Remove the left margin to avoid overflow */
                overflow-x: auto;
                /* Handles horizontal overflow */
                padding: 10px 180px;
            }

            .h3 {
                position: relative;
                display: inline-block;
                font-weight: 800;
                color: black;
                margin-top: 5%;
                margin-left: 0;
                /* Remove margin-left to prevent overflow */
                white-space: nowrap;
                /* Prevents text wrapping */
            }

            .h3::after {
                content: "";
                position: absolute;
                bottom: -5px;
                left: 0;
                width: 20%;
                height: 2px;
                background-color: black;
                opacity: 0;
                animation: fadeInOut 4s infinite;
            }

            @keyframes fadeInOut {
                0% {
                    opacity: 0;
                    transform: scaleX(0);
                    transform-origin: bottom right;
                }

                50% {
                    opacity: 1;
                    transform: scaleX(1);
                    transform-origin: bottom left;
                }

                100% {
                    opacity: 0;
                    transform: scaleX(0);
                    transform-origin: bottom left;
                }
            }

            .card {
                padding: 10px;
                border-radius: 8px;
                overflow: hidden;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .card .icon-section {
                background-color: #adafb3;
                color: white;
                padding: 16px;
            }

            .card .content-section {
                background-color: #adafb3;
                color: white;
                padding: 16px;
            }

            .col-lg-12 {
                margin-left: 0;
                /* Ensure the column isn't pushed left */
            }

            /* Added this for responsiveness and overflow control */
            @media (max-width: 768px) {
                .row {
                    margin-left: 0;
                }

                .col-md-4 {
                    width: 100%;
                    /* Ensures cards stack vertically */
                    margin-bottom: 15px;
                }
            }

            .page-wrapper {
                height: 50vh;
            }

            .low-stock-notification {
                position: absolute;
                top: 40px;
                /* Adjust as needed */
                right: 80px;
                /* Adjust alignment */
                background-color: red;
                color: white;
                padding: 12px 20px;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                font-size: 12px;
                z-index: 1000;
            }

            .d-none {
                display: none !important;
                /* Ensure it overrides other styles */
            }

            .d-block {
                display: block !important;
                /* Ensure it overrides other styles */
            }

            .btn-close {
                background: none;
                border: none;
                font-size: 16px;
                color: white;
                cursor: pointer;
                margin-left: 10px;
            }

            .main-content-inner {
                margin-top: -2%;
            }

            table {
                border-collapse: collapse;
                width: 60%;
                /* Adjust width for smaller size */
                margin: 0 auto;
                /* Center the table */
            }

            table,
            td,
            th {
                border-bottom: 0.5px solid #1874CD;
                padding: 4px;
                /* Reduce padding */
                text-transform: uppercase;
            }

            table th {
                border-left: 0.5px solid #1874CD;
                padding-top: 8px;
                /* Adjust padding */
                padding-bottom: 8px;
                text-align: left;
                color: black;
            }


            hr {
                border: solid;
                border-width: 0.5px;
                background: #072d40;
                box-shadow: 0 0 10px #2196f3, 0 0 40px #2196f3,
                    0 0 80px #2196f3;
            }

            header {
                width: 100%;
                height: 10%;
                display: flex;
                align-items: center;
                gap: 30px;
                justify-content: space-between;
                border-bottom: 1px solid;
            }

            section {
                height: 100%;
                width: 100%;
                display: flex;
            }

            aside.left-aside {
                width: 30%;
                height: 100vh;
                border-right: 1px solid;
            }

            ul {
                gap: 10px;
                padding: 10px;
                list-style: none;
            }

            nav>ul>li {
                align-items: center;
                align-self: center;
            }

            div.content {
                width: 100%;
            }

            body>header>div.image-logo {
                margin-left: 10px;
            }

            aside>ul>li,
            aside>ul>h3 {
                margin-bottom: 10px;
            }

            button {
                cursor: pointer;

                height: 2rem;
                width: 5rem;
                position: relative;
                text-transform: uppercase;
                border: solid;
                border-color: #07547d;
                background: #072d40;
                color: #2196f3;
                font-family: 'Rajdhani', sans-serif;
                text-shadow: 0 0 10px #2196f3, 0 0 40px #2196f3,
                    0 0 80px #2196f3;
                animation: move;
                animation-duration: 0.5s;
            }

            .drawing {
                border: 1px dashed;
            }

            .d-flex {
                display: flex;
            }

            .small {
                color: #00F5FF;
                text-shadow: 0 0 1px #2196f3, 0 0 10px #2196f3,
                    0 0 80px #2196f3;
            }

            .status-inactive {
                color: #EE3B3B;
            }

            .status-active {
                color: #00FF00;
            }

            .buttons {
                margin-top: 30px;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    </head>

    <body>
        <div id="low-stock-warning" class="low-stock-notification d-block">
            ⚠️ Low stock: less than 10 products available!
            <button type="button" class="btn-close" aria-label="Close" style="color:white;">X</button>
        </div>


        <div class="main-content-inner">
            <div class="row">
                <h1 class="h3">Bonjour Admin</h1>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Card 1: Produits -->
                        <div class="col-md-4 mt-md-5 mb-5">
                            <div class="card shadow-sm d-flex" style="border: none; height: 100%;">
                                <div class="d-flex"
                                    style="background-color: #adafb3; border-radius: 8px; overflow: hidden; height: 100%;">
                                    <div class="p-3 d-flex align-items-center"
                                        style="background-color: black; color: white;">
                                        <i class="fas fa-industry" style="color: white;"></i> <!-- FontAwesome Icon -->
                                    </div>
                                    <div class="p-3 flex-grow-1 text-white">
                                        <h6 class="mb-1">Produits</h6>
                                        <h2 class="mb-0">{{ $totalProduct }}</h2> <!-- Dynamic Data -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Stock -->
                        <div class="col-md-4 mt-md-5 mb-5">
                            <div class="card shadow-sm d-flex" style="border: none; height: 100%;">
                                <div class="d-flex"
                                    style="background-color: #adafb3; border-radius: 8px; overflow: hidden; height: 100%;">
                                    <div class="p-3 d-flex align-items-center"
                                        style="background-color: black; color: white;">
                                        <i class="fas fa-warehouse" style="color: white;"></i>
                                        <!-- FontAwesome Icon for Stock -->
                                    </div>
                                    <div class="p-3 flex-grow-1 text-white">
                                        <h6 class="mb-1">Stock</h6>
                                        <h2 class="mb-0">{{ $totalStock }}</h2> <!-- Dynamic Data -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Utilisateurs -->
                        <div class="col-md-4 mt-md-5 mb-5">
                            <div class="card shadow-sm d-flex" style="border: none; height: 100%;">
                                <div class="d-flex"
                                    style="background-color: #adafb3; border-radius: 8px; overflow: hidden; height: 100%;">
                                    <div class="p-3 d-flex align-items-center"
                                        style="background-color: black; color: white;">
                                        <i class="fas fa-user" style="color: white;"></i>
                                        <!-- FontAwesome Icon for Users -->
                                    </div>
                                    <div class="p-3 flex-grow-1 text-white">
                                        <h6 class="mb-1">Utilisateurs</h6>
                                        <h2 class="mb-0">{{ $totalUser }}</h2> <!-- Dynamic Data -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-md-5 mb-5">
                            <div class="card shadow-sm d-flex" style="border: none; height: 100%;">
                                <div class="d-flex"
                                    style="background-color: #adafb3; border-radius: 8px; overflow: hidden; height: 100%;">
                                    <div class="p-3 d-flex align-items-center"
                                        style="background-color: black; color: white;">
                                        <i class="fas fa-user" style="color: white;"></i>
                                        <!-- FontAwesome Icon for Users -->
                                    </div>
                                    <div class="p-3 flex-grow-1 text-white">
                                        <h6 class="mb-1">Categories</h6>
                                        <h2 class="mb-0">{{ $totalCategory }}</h2> <!-- Dynamic Data -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <a href="{{ route('stock.report') }}">Rapport Standard</a>
            <h1>Action Logs</h1>
            <div class="table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Administrateur</th>
                            <th>Notification</th>
                            <th>DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($actions as $index => $action)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $action->user->name }}</td>
                                <td class="{{ $action->action }}">
                                    {{ ucfirst(str_replace('_', ' ', $action->action)) }}
                                </td>
                                <td>{{ $action->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (auth()->user()->role->name == 'administrateur')
                    <a href="{{ route('actions') }}">See More</a>
                @endif
            </div>
            <div>
                <canvas id="lineChart"></canvas>
            </div>

            <!-- Donut Chart for Stock Movements -->
            <div>
                <canvas id="donutChart"></canvas>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctxLine = document.getElementById('lineChart').getContext('2d');
            var lineChart = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: @json(range(1, 12)), // Months 1 to 12
                    datasets: [{
                        label: 'Products per Month',
                        data: @json($productsPerMonth),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.1
                    }, {
                        label: 'Categories per Month',
                        data: @json($categoriesPerMonth),
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        fill: true,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Count'
                            }
                        }
                    }
                }
            });

            // Donut Chart for Stock Movements
            var ctxDonut = document.getElementById('donutChart').getContext('2d');
            var donutChart = new Chart(ctxDonut, {
                type: 'doughnut',
                data: {
                    labels: @json(array_keys($stockMovementCounts->toArray())), // Movement types (entry, exit, adjustment)
                    datasets: [{
                        data: @json($stockMovementCounts->toArray()),
                        backgroundColor: ['#36A2EB', '#FF6384', '#FFCD56'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                // Simulating the product count dynamically, replace this with your actual variable
                const totalProduits = {{ $totalProduct }}; // Replace with the server-side variable if dynamic

                const lowStockWarning = document.getElementById("low-stock-warning");

                // Show the low-stock warning if the count is less than 10
                if (totalProduits < 10) {
                    lowStockWarning.classList.remove("d-none");
                    lowStockWarning.classList.add("d-block");
                }
            });
            document.addEventListener("DOMContentLoaded", () => {
                const closeButton = document.querySelector("#low-stock-warning .btn-close");
                const lowStockWarning = document.getElementById("low-stock-warning");

                closeButton.addEventListener("click", () => {
                    if (lowStockWarning) {
                        lowStockWarning.classList.remove("d-block");
                        lowStockWarning.classList.add("d-none");
                    } else {
                        console.error("Low stock warning element not found!");
                    }
                });
            });
        </script>
    </body>

    </html>
@endsection
