<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

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
body {
  font-size: 0.9rem;
}

/*----------------page-wrapper----------------*/


/*----------------toggeled sidebar----------------*/


/*----------------show sidebar button----------------*/

/*----------------sidebar-content----------------*/


/*--------------------sidebar-brand----------------------*/


/*--------------------sidebar-header----------------------*/



/*-----------------------sidebar-search------------------------*/



/*----------------------sidebar-menu-------------------------*/




.page-wrapper {
  transition: margin-left 0.3s ease;
  margin-left: 0;
}

.page-wrapper.toggled {
  margin-left: 250px; /* Match the sidebar width */
}




/*--------------------------side-footer------------------------------*/



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

/*--------------------------page-content-----------------------------*/

  .page-wrapper {
    transition: all 0.3s ease;
    margin-left: 0;
  }

  .page-wrapper.toggled {
    margin-left: 250px; /* Width of the sidebar */
  }

  #sidebar {
    position: fixed;
    top: 0;
    left: -250px;
    width: 250px;
    height: 100%;
    background: #343a40;
    color: #fff;
    transition: all 0.3s ease;
    z-index: 1000;
    overflow-y: auto;
  }

  #sidebar.toggled {
    left: 0;
  }

  #show-sidebar {
    position: fixed;
    top: 15px;
    left: 15px;
    z-index: 1100;
  }

  #close-sidebar {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
  }

  .sidebar-menu a {
    display: block;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    transition: all 0.3s;
  }

  .sidebar-menu a:hover {
    background-color: #495057;
  }


/*------scroll bar---------------------*/

.sidebar-footer {

  padding: 10px 0;


}
/*-----------------------------chiller-theme-------------------------------------------------*/
.sidebar-dropdown:hover .sidebar-submenu {
  display: block;
}

/* Custom Scrollbar Styling */


.sidebar-content::-webkit-scrollbar {
  display: none; /* Hide scrollbar in WebKit browsers */
}

.sidebar-content {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}

</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>

<body>
<div class="page-wrapper chiller-theme toggled">
  <div class="page">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a>Dashboard</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header"></div>
      
      <div class="sidebar-menu">
        <a href="{{ route('dashboard') }}" class="dashboard">
          <i class="fa fa-tachometer-alt"></i>
          <span>General</span>
        </a>
        <ul>
          <li class="header-menu">
            <span>Panel</span>
          </li>

          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-chart-line"></i>
              <span>Charts</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li><a href="{{ route('Piechart') }}">Pie chart</a></li>
                <li><a href="{{ route('Linechart') }}">Line chart</a></li>
                <li><a href="{{ route('Barchart') }}">Bar chart</a></li>
              </ul>
            </div>
          </li>

          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fas fa-user"></i>
              <span>Utilisateurs</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li><a href="{{ route('users.create') }}">Ajouter utilisateur</a></li>
                <li><a href="{{ route('users.Listeutilisateur') }}">Liste utilisateurs</a></li>
              </ul>
            </div>
          </li>

          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fas fa-industry"></i>
              <span>Produits</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li><a href="{{ route('Ajoutproduit') }}">Ajouter produit</a></li>
                <li><a href="{{ route('produits.Listeproduit') }}">Liste produits</a></li>
              </ul>
            </div>
          </li>

          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fas fa-warehouse"></i>
              <span>Stocks</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li><a href="">Entrée stock</a></li>
                <li><a href="">Sortie stock</a></li>
                <li><a href="">Ajustement</a></li>
                <li><a href="">Historique de mouvement</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
      <!-- sidebar-menu -->
    </div>
    <!-- sidebar-content -->
    <div class="sidebar-footer">
      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off" style="color:red;font-size:20px;margin-top:-5%;margin-left:45%"></i>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
      </form>
    </div>
  </nav>
</div>
</div>
  <main>
    @yield('content')
  </main>  </div>
  <!-- sidebar-wrapper  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script>
        jQuery(function ($) {
  // Handle sidebar dropdowns
  $(".sidebar-dropdown > a").click(function () {
    $(".sidebar-submenu").slideUp(200);
    if ($(this).parent().hasClass("active")) {
      $(".sidebar-dropdown").removeClass("active");
      $(this).parent().removeClass("active");
    } else {
      $(".sidebar-dropdown").removeClass("active");
      $(this).next(".sidebar-submenu").slideDown(200);
      $(this).parent().addClass("active");
    }
  });

  // Close sidebar
  $("#close-sidebar").click(function () {
    $(".page-wrapper").removeClass("toggled");
    adjustPageLayout(false); // Adjust content position
  });

  // Show sidebar
  $("#show-sidebar").click(function () {
    $(".page-wrapper").addClass("toggled");
    adjustPageLayout(true); // Adjust content position
  });

  // Adjust page layout based on sidebar visibility
  function adjustPageLayout(isToggled) {
    const pageWrapper = $(".page-wrapper");
    if (isToggled) {
      pageWrapper.css("margin-left", "250px"); // Adjust this value as needed
    } else {
      pageWrapper.css("margin-left", "0");
    }
  }
});

    </script>
    <script>
  document.addEventListener("DOMContentLoaded", function () {
    const showSidebar = document.getElementById("show-sidebar");
    const closeSidebar = document.getElementById("close-sidebar");
    const pageWrapper = document.querySelector(".page-wrapper");
    const sidebar = document.getElementById("sidebar");

    showSidebar.addEventListener("click", function (e) {
      e.preventDefault();
      sidebar.classList.add("toggled");
      pageWrapper.classList.add("toggled");
      showSidebar.style.display = "none"; // Hide the toggle button
      // Force a layout recalculation for immediate effect
      setTimeout(() => pageWrapper.style.marginLeft = "250px", 0);
    });

    closeSidebar.addEventListener("click", function () {
      sidebar.classList.remove("toggled");
      pageWrapper.classList.remove("toggled");
      showSidebar.style.display = "block"; // Show the toggle button
      // Reset the margin immediately
      pageWrapper.style.marginLeft = "0";
    });
  });
</script>


</body>

</html>