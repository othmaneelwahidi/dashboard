<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <style>
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

        body,
        html {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            /* Prevent horizontal scrolling */
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        a:hover {
         color: #444950;
            /* Hover effect for links */
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            /* Fixed sidebar width */
            min-width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #2d333a;
            /* Dark background for sidebar */
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px;
            overflow-y: auto;
            /* Vertical scroll for long content */
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
            /* Smooth toggle effect */
        }

        .sidebar h1 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #ffffff;
            text-transform: uppercase;
        }

        /*--------------------------side-footer------------------------------*/

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
            margin-left: 250px;
            /* Width of the sidebar */
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

        .sidebar-toggle {
            display: block;
            /* Show toggle button on smaller screens */
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

        a:hover {
            text-decoration: none;
        }
        ul {
  gap: 10px;
  padding:20px;
  list-style: none;
} 
.dropdown > a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
}

.submenu {
    max-height: 0;
    overflow: hidden;
    flex-direction: column;
    transition: max-height 0.3s ease-in-out, padding 0.3s ease-in-out;
}

.submenu li {
    margin-top: 10px; /* Gap between each list item */
}

.submenu li:first-child {
    margin-top: 0; /* Remove the top margin for the first item */
}

.dropdown.open > .submenu {
    max-height: 200px; /* Adjust based on the content size */
    padding-top: 10px; /* Add padding for better spacing */
    padding-bottom: 10px;
}
.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul > li {
    margin-bottom: 50px; /* Increased gap for parent list items */
}

.sidebar ul > li:last-child {
    margin-bottom: 0; /* Removes gap after the last item */
}

.sidebar ul li a {
    color: #ffffff;
    font-size: 16px;
    display: flex;
    align-items: center;
    text-decoration: none;
}

.sidebar ul li a i {
    margin-right: 10px;
    font-size: 18px;
}
.logout{
    margin-top:50%;
    margin-left:45%;

}

    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
    <h1>Dashboard</h1>
    <ul>
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> General
            </a>
        </li>
        <li class="dropdown">
            <a href="#" onclick="toggleMenu(event)">
                <i class="fas fa-user"></i> Utilisateurs <i class="fas fa-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('users.index') }}">Listes Utilisateurs</a></li>
                <li><a href="{{ route('users.create') }}">Ajouter Utilisateurs</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" onclick="toggleMenu(event)">
                <i class="fas fa-box"></i> Produits <i class="fas fa-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('produits.index') }}">Listes Produits</a></li>
                <li><a href="{{ route('produits.create') }}">Ajouter Produits</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" onclick="toggleMenu(event)">
                <i class="fas fa-th"></i> Catégorie <i class="fas fa-chevron-down"></i>
            </a>
            <ul class="submenu">
                <li>Liste Catégories</li>
                <li>Ajouter Catégorie</li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fas fa-warehouse"></i> Stocks</a>
        </li>
    </ul>
    <div class="logout">
        <a href="{{route('logout')}}"><i class="fas fa-power-off" style="color:red;"></i></a>
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
    <script>
    function toggleMenu(event) {
        event.preventDefault();
        const parent = event.target.closest(".dropdown");
        parent.classList.toggle("open");
    }
</script>

    <main>
        @yield('content')
    </main>
    </div>
</body>

</html>
