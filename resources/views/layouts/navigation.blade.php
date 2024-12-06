<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
 
<style>
    @keyframes swing {
  0% {
    transform: rotate(0deg);
  }
  10% {
    transform: rotate(10deg);
  }
  30% {
    transform: rotate(0deg);
  }
  40% {
    transform: rotate(-10deg);
  }
  50% {
    transform: rotate(0deg);
  }
  60% {
    transform: rotate(5deg);
  }
  70% {
    transform: rotate(0deg);
  }
  80% {
    transform: rotate(-5deg);
  }
  100% {
    transform: rotate(0deg);
  }
}

@keyframes sonar {
  0% {
    transform: scale(0.9);
    opacity: 1;
  }
  100% {
    transform: scale(2);
    opacity: 0;
  }
}
body, html {
    margin: 0;
    padding: 0;
    overflow-x: hidden; /* Prevent horizontal scrolling */
    font-family: Arial, sans-serif;
    box-sizing: border-box;
}

ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

a {
    text-decoration: none;
    color: #fff;
    display: block;
    padding: 10px 20px;
    border-radius: 5px;
}

a:hover {
    background-color: #444950; /* Hover effect for links */
}

/* Sidebar styles */
.sidebar {
    width: 250px; /* Fixed sidebar width */
    min-width: 250px;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    background-color: #2d333a; /* Dark background for sidebar */
    color: #fff;
    display: flex;
    flex-direction: column;
    padding: 20px;
    overflow-y: auto; /* Vertical scroll for long content */
    z-index: 1000;
    transition: transform 0.3s ease-in-out; /* Smooth toggle effect */
}

.sidebar h1 {
    font-size: 20px;
    margin-bottom: 20px;
    color: #ffffff;
    text-transform: uppercase;
}

.sidebar ul li {
    margin-bottom: 10px;
}

.sidebar ul li a {
    color: #ffffff;
    font-size: 16px;
    display: flex;
    align-items: center;
}

.sidebar ul li a i {
    margin-right: 10px;
    font-size: 18px;
}

/* Sidebar toggle button (optional) */
.sidebar-toggle {
    display: none;
    position: absolute;
    top: 20px;
    left: 270px;
    background-color: #2d333a;
    border: none;
    color: white;
    padding: 10px;
    cursor: pointer;
    z-index: 1001;
}

/* Content styles */
.content {
    margin-left: 250px; /* Matches sidebar width */
    padding: 20px;
    
    transition: margin-left 0.3s ease-in-out; /* Smooth transition for toggling sidebar */
}

.content h2 {
    font-size: 24px;
    margin-bottom: 10px;
}

.content p {
    line-height: 1.6;
}

/* Responsive design */
@media (max-width: 768px) {
    .sidebar {
        width: 200px; /* Adjust sidebar width */
    }

    .content {
        margin-left: 200px; /* Adjust content margin */
    }

    .sidebar-toggle {
        display: block; /* Show toggle button on smaller screens */
    }
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
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
        <h1>Dashboard</h1>
        <ul>
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> General</a></li>
            <li class="collapsible">
                <a href="#"><i class="fas fa-chart-line"></i> Charts</a>
                <ul>
                    <li><a href="#">Pie chart</a></li>
                    <li><a href="#">Line chart</a></li>
                    <li><a href="#">Bar chart</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-user"></i> Utilisateurs</a></li>
            <li><a href="#"><i class="fas fa-box"></i> Produits</a></li>
            <li><a href="#"><i class="fas fa-warehouse"></i> Stocks</a></li>
        </ul>
        <div class="logout">
            <a href="#"><i class="fas fa-power-off"></i></a>
        </div>
    </div>



    <!-- JavaScript for Collapsible Menu -->
    <script>
        const collapsibleMenus = document.querySelectorAll('.collapsible');
        collapsibleMenus.forEach(menu => {
            menu.addEventListener('click', () => {
                menu.classList.toggle('open');
            });
        });
    </script>
  <main>
    @yield('content')
  </main>  </div>
</body>

</html>