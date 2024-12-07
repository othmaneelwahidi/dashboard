@extends('layouts.navigation')
@extends('layouts.navbar')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    h1{
        text-align:center;
        justify-content:center;
        align-items:center;
    }
    .row {
    margin-top: -19px; /* Adjust margin to a smaller value */
    justify-content: flex-end; /* Align the content of the row to the right */
    padding-left: 0;  /* Ensure no extra padding on the left */
    padding-right: 0; /* Ensure no extra padding on the right */
}

    .badge-sonarr {
        display: inline-block;
        background: #980303;
        border-radius: 50%;
        height: 8px;
        width: 8px;
        margin-left: 2%;
        margin-top: 5%;
        position: absolute;
        top: 0;
    }
    .badge-sonarr {
        background-color: green !important;
    }
    body {
            background: linear-gradient(135deg, #e4e4e4, #1e1e1e);
            color: #e4e4e4;
            font-family: 'Arial', sans-serif;
       
            margin: 0;
        }
    .badge-sonarr:after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        border: 2px solid green;
        opacity: 0;
        border-radius: 50%;
        width: 100%;
        height: 100%;
        animation: sonar 1.5s infinite;
    }
    .statue {
        display: flex;
    }
    /* Remove overflow-x */
    body, .container-fluid {
        overflow-x: hidden; /* Prevent horizontal scrolling */
    }
</style>
</head>
<body>
    <div>
<div class="row justify-content-end"> <!-- Use Bootstrap's justify-content-end to align right -->
    <div class="col-lg-10">
        <div class="row">
            <!-- Card 1: Produits -->
            <div class="col-md-3 mt-md-5 mb-5">
                <div class="card shadow-sm d-flex" style="border: none; height: 100%;">
                    <div class="d-flex" style="background-color: #adafb3; overflow: hidden; height: 100%;">
                        <div class="p-3 d-flex align-items-center" style="background-color: #adafb3; color: white;">
                        </div>
                        <div class="p-3 flex-grow-1 text-white">
                            <div class="statue"> 
                                <h6 class="mb-1">Statue  <span class="badge-sonarr"></span></h6>
                            </div>  
                            <h2 class="mb-0">{{ Auth::user()->role->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div>
<!-- Check if the user is authenticated -->
@if(Auth::check())
    <h1>Bonjour, {{ Auth::user()->name }}</h1>
@endif

</body>
</html>
@endsection
