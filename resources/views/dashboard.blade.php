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
            width: 90%; /* Wider chart */
            max-width: 1000px; /* Bigger maximum size */
            height: 500px; /* Increased height */
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(169, 169, 169, 0.5);
            background: rgba(43, 43, 43, 0.95);
            margin-left: 20%;
            margin-top:5%;
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
            margin: 0; /* Remove the left margin to avoid overflow */
            overflow-x: auto; /* Handles horizontal overflow */
            padding: 10px 180px;
        }

        .h3 {
            position: relative;
            display: inline-block;
            font-weight: 800;
            color: black;
            margin-top: 5%;
            margin-left: 0; /* Remove margin-left to prevent overflow */
            white-space: nowrap; /* Prevents text wrapping */
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
            margin-left: 0; /* Ensure the column isn't pushed left */
        }

        /* Added this for responsiveness and overflow control */
        @media (max-width: 768px) {
            .row {
                margin-left: 0;
            }
            .col-md-4 {
                width: 100%; /* Ensures cards stack vertically */
                margin-bottom: 15px;
            }
        }

        .page-wrapper {
            height: 50vh;
        }
        
        .low-stock-notification {
    position: absolute;
    top: 40px; /* Adjust as needed */
    right: 80px; /* Adjust alignment */
    background-color: red;
    color: white;
    padding: 12px 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    font-size: 12px;
    z-index: 1000;
}

.d-none {
    display: none !important; /* Ensure it overrides other styles */
}

.d-block {
    display: block !important; /* Ensure it overrides other styles */
}

.btn-close {
    background: none;
    border: none;
    font-size: 16px;
    color: white;
    cursor: pointer;
    margin-left: 10px;
}
.main-content-inner{
    margin-top:-2%;
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
                            <div class="d-flex" style="background-color: #adafb3; border-radius: 8px; overflow: hidden; height: 100%;">
                                <div class="p-3 d-flex align-items-center" style="background-color: black; color: white;">
                                    <i class="fas fa-industry" style="color: white;"></i> <!-- FontAwesome Icon -->
                                </div>
                                <div class="p-3 flex-grow-1 text-white">
                                    <h6 class="mb-1">Produits</h6>
                                    <h2 class="mb-0">{{ $totalProduits }}</h2> <!-- Dynamic Data -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Stock -->
                    <div class="col-md-4 mt-md-5 mb-5">
                        <div class="card shadow-sm d-flex" style="border: none; height: 100%;">
                            <div class="d-flex" style="background-color: #adafb3; border-radius: 8px; overflow: hidden; height: 100%;">
                                <div class="p-3 d-flex align-items-center" style="background-color: black; color: white;">
                                    <i class="fas fa-warehouse" style="color: white;"></i> <!-- FontAwesome Icon for Stock -->
                                </div>
                                <div class="p-3 flex-grow-1 text-white">
                                    <h6 class="mb-1">Stock</h6>
                                    <h2 class="mb-0"></h2> <!-- Dynamic Data -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Utilisateurs -->
                    <div class="col-md-4 mt-md-5 mb-5">
                        <div class="card shadow-sm d-flex" style="border: none; height: 100%;">
                            <div class="d-flex" style="background-color: #adafb3; border-radius: 8px; overflow: hidden; height: 100%;">
                                <div class="p-3 d-flex align-items-center" style="background-color: black; color: white;">
                                    <i class="fas fa-user" style="color: white;"></i> <!-- FontAwesome Icon for Users -->
                                </div>
                                <div class="p-3 flex-grow-1 text-white">
                                    <h6 class="mb-1">Utilisateurs</h6>
                                    <h2 class="mb-0">{{ $totalUsers }}</h2> <!-- Dynamic Data -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <div style="width: 80%; margin: auto;">
        <canvas id="quantityChart"></canvas>
    </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Prepare the data from PHP to JavaScript
        const totalProduits = @json($totalProduits); // Total products count from backend
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']; // Month labels

        // Create an array with totalProduits repeated for each month
        const totalProduitsArray = Array(months.length).fill(totalProduits);

        // Create the chart
        const ctx = document.getElementById('quantityChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line', // Line chart type
            data: {
                labels: months, // X-axis labels (Months)
                datasets: [
                    {
                        label: 'Total Products', // Label for the line
                        data: totalProduitsArray, // Data for the line (flat line for total products)
                        borderColor: 'rgba(255, 0, 0, 1)', // Line color (Red)
                        backgroundColor: 'rgba(255, 0, 0, 0.1)', // Slight red background
                        borderWidth: 3,
                        fill: false, // No filling under the line
                        tension: 0, // No smoothing for the line
                        pointRadius: 0, // No points on the line
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month', // X-axis shows the months
                            color: 'rgba(255, 255, 255, 0.8)'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)' // Grid lines color
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Products', // Y-axis shows the total products
                            color: 'rgba(255, 255, 255, 0.8)'
                        },
                        beginAtZero: true, // Start the Y-axis at zero
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)' // Grid lines color
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 255, 255, 0.8)', // Tooltip background color
                        titleColor: '#fff',
                        bodyColor: '#fff',
                    }
                }
            }
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        // Simulating the product count dynamically, replace this with your actual variable
        const totalProduits = {{$totalProduits}}; // Replace with the server-side variable if dynamic

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
