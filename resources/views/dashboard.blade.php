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
            /* Media Query for Extra Small Screens (Phones) */
            @media (max-width: 576px) {
                .chart-container {
                    width: 95%;
                    margin-left: 2%;
                    height: auto;
                    /* Allow adaptive height */
                    padding: 10px;
                }

                .h3 {
                    font-size: 1.2rem;
                    margin-top: 10%;
                }

                .card {
                    flex-direction: column;
                }

                .main-content-inner {
                    margin-left: 5%;
                }

                table {
                    width: 80%;
                    margin-left: 0;
                    font-size: 12px;
                }

                #btn-download {
                    top: auto;
                    left: auto;
                    margin: 20px auto;
                }
            }

            /* Media Query for Small Screens (Tablets) */
            @media (min-width: 577px) and (max-width: 768px) {
                .chart-container {
                    width: 90%;
                    margin-left: 5%;
                    height: 400px;
                }

                .h3 {
                    font-size: 1.4rem;
                    margin-right: 0;
                }

                table {
                    width: 80%;
                }

                .charts {
                    gap: 10px;
                }
            }

            /* Media Query for Medium Screens (Laptops) */
            @media (min-width: 769px) and (max-width: 1024px) {
                .chart-container {
                    width: 85%;
                    margin-left: 7.5%;
                }

                .h3 {
                    font-size: 1.6rem;
                    margin-top: 8%;
                }

                table {
                    width: 70%;
                    margin-left: 15%;
                }
            }

            /* Media Query for Large Screens (Desktops) */
            @media (min-width: 1025px) {
                .chart-container {
                    width: 80%;
                    margin-left: 10%;
                }

                .h3 {
                    font-size: 2rem;
                }

                table {
                    width: 60%;
                }
            }

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
                padding: 15px 70px;
            }

            .h3 {
                position: relative;
                display: inline-block;
                font-weight: 800;
                color: black;
                margin-top: 5%;
                margin-right: -5%;
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

                canvas {
                    display: block;
                }

                .chart-container {
                    width: 80%;
                    margin: auto;
                    padding-top: 50px;
                }


                .h3 {
                    position: relative;
                    display: inline-block;
                    font-weight: 800;
                    color: black;
                    margin-top: 5%;
                    margin-right: -5%;
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
                    margin-left: 8%;
                }

                table {
                    border-collapse: collapse;
                    width: 40%;
                    /* Adjust width for smaller size */
                    margin: 0 auto;
                    /* Center the table */
                    margin-left: 10%;
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
                    height: 40%;
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
                    padding: 18px;
                    list-style: none;
                }

                nav>ul>li {
                    align-items: center;
                    align-self: center;
                }

                div.content {
                    width: 80%;
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

                .charts {
                    margin-left: 18px;
                    display: flex;
                    justify-content: center;
                    /* Centers all charts horizontally */
                    align-items: center;
                    /* Aligns all charts vertically */
                    gap: 12px;
                    /* Adds spacing between charts */
                    flex-wrap: wrap;
                    /* Allows wrapping if the screen size is small */
                }

                .chart {
                    text-align: center;
                    /* Centers the chart content if needed */
                }

                .Rapport {
                    margin-left: 10%;
                    color: black;
                }

                .Rapport:hover {
                    background: none;
                    text-decoration: none;
                }

                /* Button Base Styles */
                #btn-download {
                    margin-left: -10%;
                    margin-top: 10%;
                    cursor: pointer;
                    display: block;
                    width: 52px;
                    height: 52px;
                    border-radius: 50%;
                    -webkit-tap-highlight-color: transparent;
                    position: absolute;
                    top: calc(50% - 24px);
                    left: calc(50% - 24px);
                    background: rgba(0, 0, 0, 0);
                    /* Transparent by default */
                    transition: background 0.3s ease;
                }



                /* SVG Styles */
                #btn-download svg {
                    margin: 0px 0 0 0px;
                    fill: none;
                    transform: translate3d(0, 0, 0);
                }

                /* Path and Polyline Styling */
                #btn-download polyline,
                #btn-download path {
                    stroke: #0077FF;
                    stroke-width: 2;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                    transition: all 0.3s ease;
                    transition-delay: 0.3s;
                }

                /* Checkmark Path Animation */
                #btn-download path#check {
                    stroke-dasharray: 38;
                    stroke-dashoffset: 114;
                    /* Hidden by default */
                    transition: all 0.4s ease;
                }

                #btn-download.downloaded svg .svg-out {
                    opacity: 0;
                    animation: drop 0.3s linear;
                    transition-delay: 0.4s;
                }

                #btn-download.downloaded path#check {
                    stroke: #20CCA5;
                    /* Green stroke for the checkmark */
                    stroke-dashoffset: 174;
                    /* Makes the checkmark visible */
                    transition-delay: 0.4s;
                }

                /* Drop Animation for the Arrow */
                @keyframes drop {
                    20% {
                        transform: translate(0, -3px);
                    }

                    80% {
                        transform: translate(0, 2px);
                    }

                    95% {
                        transform: translate(0, 0);
                    }
                }

                .btn-bt {
                    margin-bottom: 19%;
                }

                #download {
                    font-size: 30px;
                }

                #download:hover {
                    background-color: white;
                }

                .Telecharger {
                    font-size: 24px;
                    margin-left: 10%;
                    margin-top: 3%;
                }

                .row {
                    margin-left: 10%;
                }
            }

            #wrap {
                margin: 20px auto;
                text-align: center;
            }

            .table {
                margin-left: 10%;
                width: 85%;
                max-width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
            }

            .btn-slide,
            .btn-slide2 {
                position: relative;
                display: inline-block;
                height: 50px;
                width: 200px;
                line-height: 50px;
                padding: 0;
                border-radius: 50px;
                background: #fdfdfd;
                border: 2px solid #0099cc;
                margin: 10px;
                transition: .5s;
            }

            .btn-slide2 {
                border: 2px solid #016306;
            }

            .btn-slide:hover {
                background-color: #016306;
            }

            .btn-slide2:hover {
                background-color: #016306;
            }

            .btn-slide:hover span.circle,
            .btn-slide2:hover span.circle2 {
                left: 100%;
                margin-left: -45px;
                background-color: #fdfdfd;
                color: #016306;
            }

            .btn-slide2:hover span.circle2 {
                color: #016306;
            }

            .btn-slide:hover span.title,
            .btn-slide2:hover span.title2 {
                left: 40px;
                opacity: 0;
            }

            .btn-slide:hover span.title-hover,
            .btn-slide2:hover span.title-hover2 {
                opacity: 1;
                left: 40px;
            }

            .btn-slide span.circle,
            .btn-slide2 span.circle2 {
                display: block;
                background-color: #016306;
                color: #fff;
                position: absolute;
                float: left;
                margin: 5px;
                line-height: 42px;
                height: 40px;
                width: 40px;
                top: 0;
                left: 0;
                transition: .5s;
                border-radius: 50%;
            }

            .btn-slide2 span.circle2 {
                background-color: #016306;
            }

            .btn-slide span.title,
            .btn-slide span.title-hover,
            .btn-slide2 span.title2,
            .btn-slide2 span.title-hover2 {
                position: absolute;
                left: 90px;
                text-align: center;
                margin: 0 auto;
                font-size: 16px;
                font-weight: bold;
                color: #016306;
                transition: .5s;
            }

            .btn-slide2 span.title2,
            .btn-slide2 span.title-hover2 {
                color: #016306;
                left: 80px;
            }

            .btn-slide span.title-hover,
            .btn-slide2 span.title-hover2 {
                left: 80px;
                opacity: 0;
            }

            .btn-slide span.title-hover,
            .btn-slide2 span.title-hover2 {
                color: #fff;
            }

            .btn-bte {
                margin-bottom: 5%;
                margin-top: 8%;
                margin-left: 30%;
            }

            /* General chart container styling */
            canvas {
                background-color: #1a1a1a;
                border-radius: 10px;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
                border: 1px solid #444;
            }

            /* Line Chart specific styling */
            #lineChart {
                width: 100%;
                height: 400px;
                border-radius: 10px;
                background-image: linear-gradient(to bottom, #2e3b4e, #1f2937);
                border: 1px solid #3a4754;
            }

            #lineChart .chartjs-tooltip {
                background-color: rgba(0, 0, 0, 0.75);
                border-radius: 5px;
                color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }

            #lineChart .chartjs-tooltip .tooltip-inner {
                font-size: 14px;
                padding: 5px 10px;
            }

            /* Donut Chart specific styling */
            #donutChart {
                width: 100%;
                height: 400px;
                border-radius: 50%;
                background-image: linear-gradient(to bottom, #1a202c, #2d3748);
                border: 1px solid #444;
            }

            #donutChart .chartjs-tooltip {
                background-color: rgba(0, 0, 0, 0.75);
                border-radius: 5px;
                color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }

            #donutChart .chartjs-tooltip .tooltip-inner {
                font-size: 14px;
                padding: 5px 10px;
            }

            /* Customize the tooltip arrow */
            .chartjs-tooltip .tooltip-arrow {
                border-color: rgba(0, 0, 0, 0.75) !important;
            }

            /* Tooltip styling */
            .chartjs-tooltip {
                opacity: 0.9 !important;
                padding: 10px;
                font-size: 12px;
                background-color: rgba(51, 51, 51, 0.8);
                color: #fff;
                border-radius: 5px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            }

            /* Interactive hover effects */


            /* Styling for chart legends */
            .chartjs-legend {
                color: #fff;
                font-size: 14px;
                font-weight: 600;
                padding: 10px 0;
            }

            /* Line chart data set hover effect */
            .chartjs-render-monitor .dataset-hover {
                transition: all 0.3s ease;
            }

            .chartjs-render-monitor .dataset-hover:hover {
                border-width: 3px;
                box-shadow: 0px 4px 12px rgba(255, 255, 255, 0.6);
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


        <div class="main-content-inner" style="margin-left: 250px;">
            <div class="row">
                <h1 class="h3">Bonjour Admin</h1>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-between">
                        <!-- Card 1: Produits -->
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
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
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
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
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
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

                        <!-- Card 4: Categories -->
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card shadow-sm d-flex" style="border: none; height: 100%;">
                                <div class="d-flex"
                                    style="background-color: #adafb3; border-radius: 8px; overflow: hidden; height: 100%;">
                                    <div class="p-3 d-flex align-items-center"
                                        style="background-color: black; color: white;">
                                        <i class="fas fa-tags" style="color: white;"></i>
                                        <!-- FontAwesome Icon for Categories -->
                                    </div>
                                    <div class="p-3 flex-grow-1 text-white">
                                        <h6 class="mb-1">Catégories</h6>
                                        <h2 class="mb-0">{{ $totalCategory }}</h2> <!-- Dynamic Data -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-bt">
                <div class="btn-bt">
                    <h2 class="Rapport">Rapport Standard</h2>
                    <h4 class="Telecharger">Télécharger le fichier :</h4>
                </div>
            </div>
            <div id="btn-download">

                <div id="wrap">
                    <a href="{{ route('stock.report') }}" id="download" class="btn-slide2">
                        <span class="circle2"><i class="fa fa-download"></i></span>
                        <span class="title2">Download</span>
                        <span class="title-hover2">Click here</span>
                    </a>
                </div>


            </div>
        </div>
        @if (auth()->user()->role->name == 'Administrateur' || auth()->user()->role->name == 'Utilisateur Standard')
            <div class="btn-bt">
                <h2 class="Rapport">Rapport Personnalisés:</h2>
                <h4 class="Telecharger">Personnaliser votre rapport:</h4>
                <div id="btn-download">

                    <a href="{{ route('reports.index') }}">


                        <span>Click here</span>
                    </a>


                </div>
            </div>
        @endif

        <div class="content">
            <div class="table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Utilisateur</th>
                            <th>Notification</th>
                            <th>details</th>
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
                                <td>{{ $action->details }}</td>
                                <td class="status-inactive">{{ $action->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (auth()->user()->role->name == 'Administrateur')
                    <a href="{{ route('actions') }}">See More</a>
                @endif
            </div>
            <div></div>
            <canvas id="lineChart" class="chart" style="width: 40%; margin: auto;"></canvas>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctxLine = document.getElementById('lineChart').getContext('2d');
            var lineChart = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: @json(range(1, 12)),
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
                document.querySelector('.Rapport').addEventListener('click', function() {
                    this.classList.add('downloaded');
                    setTimeout(() => this.classList.remove('downloaded'),
                        2000); // Reset animation after 2 seconds
                });

            });
        </script>
        <script>
            const downloadButton = document.getElementById("btn-download");

            downloadButton.addEventListener("click", () => {
                downloadButton.classList.toggle("downloaded");
            });
        </script>
    </body>

    </html>
@endsection
