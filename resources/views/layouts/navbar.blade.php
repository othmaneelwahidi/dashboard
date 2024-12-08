
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
        .gap{
      margin-right:20%;
      margin-left:-20%;
        }
        .profile-icon {
            margin-bottom:6px;
          margin-top:8px;
            font-size: 20px;          /* Size of the icon */
            width: 30px;              /* Width of the icon circle */
            height: 30px;             /* Height of the icon circle */
            background-color: gray; /* Background color */
            color: white;             /* Icon color */
            border-radius: 50%;       /* Makes the icon circular */
            display: flex;
            justify-content: center;  /* Centers the icon horizontally */
            align-items: center;      /* Centers the icon vertically */
            border: 3px solid white;  /* Optional: White border around the icon */
        }
        .navbar-expand-lg {
            margin-top:-20px;
        }
        .badge-sonar {
  background-color: orange!important;
  margin-right:2%;

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
#bell{
    font-size:20px;
    color:gray;
 
}
#bell:hover{
    color:black;
}
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container-fluid">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            <div class="gap">
    <li class="nav-item">
        <a href="#" class="nav-link position-relative">
            <i class="fa fa-bell" id="bell"></i>
            <span class="badge-sonar" id="sonar"></span>
        </a>
    </li>
</div>


                <li class="nav-item">
                    
                    <a class="nav-link active" aria-current="page" href="{{ route('Userprofile') }}"><div class="profile-icon">
    <i class="fas fa-user"></i> <!-- FontAwesome User Icon -->
</div></a>
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
  const totalProduct = $totalProduct; ; // Assuming you're using PHP to output the value

  const badgeSonar = document.getElementById('badge-sonar');

  // Check if totalProduct is less than 10 to display the sonar
  if (totalProduct < 10) {
    badgeSonar.style.display = 'inline-block'; // Show the sonar
  } else {
    badgeSonar.style.display = 'none'; // Hide the sonar
  }
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Accessing the total product count dynamically from the server-side variable
        const totalProduits = $totalProduct ; // Replace with the server-side variable passed from the controller

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
        document.querySelector('.Rapport').addEventListener('click', function () {
            this.classList.add('downloaded');
            setTimeout(() => this.classList.remove('downloaded'), 2000); // Reset animation after 2 seconds
        });
    });
</script>

</body>

</html>
