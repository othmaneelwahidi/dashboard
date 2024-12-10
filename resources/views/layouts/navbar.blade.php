<html>

<head>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Rounded" rel="stylesheet">

    <style>
        .navbar {

            margin-bottom: 10px;
        }

        .navbar-nav {
            align-items: center;
        }

        .nav-link {
            color: white !important;

        }

        .nav-link:hover {
            color: black !important;
        }

        /* Custom background color for navbar */
        .navbar-custom {
            background-color: #cacccf !important;
        }

        .gap {
            margin-right: 20%;
            margin-left: -20%;
        }

        .profile-icon {
            margin-bottom: 6px;
            margin-top: 8px;
            font-size: 20px;
            /* Size of the icon */
            width: 30px;
            /* Width of the icon circle */
            height: 30px;
            /* Height of the icon circle */
            background-color: gray;
            /* Background color */
            color: white;
            /* Icon color */
            border-radius: 50%;
            /* Makes the icon circular */
            display: flex;
            justify-content: center;
            /* Centers the icon horizontally */
            align-items: center;
            /* Centers the icon vertically */
            border: 3px solid white;
            /* Optional: White border around the icon */
        }

        .navbar-expand-lg {
            margin-top: -20px;
        }

        .badge-sonar {
            background-color: orange !important;
            margin-right: 2%;

        }

        .badge-sonar {
            display: inline-block;
            background: #980303;
            border-radius: 50%;
            height: 8px;
            width: 8px;
            position: absolute;
            top: 0;

        }

        .badge-sonar:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            border: 2px solid #980303;
            opacity: 0;
            border-radius: 50%;
            width: 100%;
            height: 100%;
            animation: sonar 1.5s infinite;
        }

        #bell {
            font-size: 20px;
            color: gray;

        }

        #bell:hover {
            color: black;
        }

        .dropdown-container {
            display: none;
            position: absolute;
            bottom: -103px;
            right: 0;
            top: 12px background-color: #808080;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2), 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 250px;
            z-index: 1000;
            padding: 15px;
            transition: all 0.3s ease;
        }

        .dropdown-container ul {
            list-style: none;
            margin: 0;
            padding: 0;
            color: #000;
            /* Black text for contrast */
        }

        .dropdown-container ul li {
            padding: 12px 20px;
            border-bottom: 1px solid #444;
            /* Darker separator for a sleek look */
            font-size: 16px;
            font-weight: 500;
            color: #000;
            /* Black text */
            transition: background-color 0.3s ease, transform 0.2s ease;
            /* Animation effects */
        }

        .dropdown-container ul li:last-child {
            border-bottom: none;
        }

        .dropdown-container ul li:hover {
            background-color: rgba(0, 0, 0, 0.1);
            /* Subtle hover effect */
            color: #000;
            /* Black text on hover */
            transform: translateX(5px);
            /* Slightly shift the item for interaction */
        }

        .dropdown-container ul li:active {
            background-color: rgba(0, 0, 0, 0.2);
            /* Darker background on click */
            transform: translateX(3px);
            /* Subtle click effect */
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <div class="gap">
                        <li class="nav-item">
                            <a href="#" class="nav-link position-relative" id="bell-notification">
                                <i class="fa fa-bell" id="bell"></i>
                                <span class="badge-sonar" id="sonar"
                                    style="{{ $lowStockCount > 0 ? 'display: inline-block;' : 'display: none;' }}">
                                </span>
                            </a>
                            <!-- Dropdown container -->
                            <div id="notification-dropdown" class="dropdown-container">
                                <ul>
                                    @if($lowStockProducts->count() > 0)
                                        @foreach($lowStockProducts as $product)
                                            <li>⚠️ Low stock: {{ $product->name }} ({{ $product->total_stock }} left).</li>
                                        @endforeach
                                    @else
                                        <li>No new notifications.</li>
                                    @endif
                                </ul>
                            </div>                            
                        </li>
                    </div>


                    <li class="nav-item">

                        <a class="nav-link active" aria-current="page" href="{{ route('Userprofile') }}">
                            <div class="profile-icon">
                                <i class="fas fa-user"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container">
        <div class="row">
            <!-- Content Goes Here -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const lowStockCount = @json($lowStockCount); // Pass the PHP variable to JavaScript
        const badgeSonar = document.getElementById('sonar');

        // Check if the low stock count is greater than 0
        badgeSonar.style.display = lowStockCount > 0 ? 'inline-block' : 'none';
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Accessing the total product count dynamically from the server-side variable
            const totalProduits = $totalProduct; // Replace with the server-side variable passed from the controller

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

            // Animation for the .Rapport element when clicked
            document.querySelector('.Rapport').addEventListener('click', function() {
                this.classList.add('downloaded');
                setTimeout(() => this.classList.remove('downloaded'),
                    2000); // Reset animation after 2 seconds
            });

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const bellNotification = document.getElementById("bell-notification");
            const notificationDropdown = document.getElementById("notification-dropdown");

            // Ensure the dropdown is hidden by default
            notificationDropdown.style.display = "none";

            // Add click event listener to the bell
            bellNotification.addEventListener("click", function(e) {
                e.preventDefault();
                // Toggle dropdown visibility
                if (notificationDropdown.style.display === "none" || notificationDropdown.style.display ===
                    "") {
                    notificationDropdown.style.display = "block"; // Show dropdown
                } else {
                    notificationDropdown.style.display = "none"; // Hide dropdown
                }
            });

            // Optional: Close dropdown when clicking outside
            document.addEventListener("click", function(event) {
                if (!bellNotification.contains(event.target) && !notificationDropdown.contains(event
                    .target)) {
                    notificationDropdown.style.display = "none"; // Close dropdown if clicking outside
                }
            });
        });
    </script>

</body>

</html>
