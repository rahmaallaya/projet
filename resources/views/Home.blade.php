@extends('layouts.app')

@section('title', 'Home')

@section('content')
<st    
    /* Styles spécifiques à la page d'accueil *//    .home-page {
        background-image: url("{{ asset('images/HomeImage.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding-left: 100px;
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin-top: 0px; /* Supprime l'espace en compensant le padding de main */
        margin-bottom: -80px;
    }

    .home-content {
        max-width: 800px;
       
    }

    .home-content h1 {
        font-size: 4.5rem;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .home-content .lead {
        font-size: 2rem;
        margin-bottom: 40px;
    }

    .home-content .btn {
        font-size: 1.5rem;
        padding: 15px 40px;
        border-radius: 30px;
        transition: all 0.3s ease;
    }

    .home-content .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
    }

    .home-content .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }

    .home-content .btn-outline-light {
        border-color: #ffffff;
        color: #ffffff;
    }

    .home-content .btn-outline-light:hover {
        background-color: #ffffff;
        color: #3498db;
    }
    

    /* Agrandir le navbar */
    .navbar-nav .nav-link {
        font-size: 1.2rem; /* Augmente la taille de la police des liens */
    }
</style>

<div class="home-page">
    <div class="home-content text-start">
        <h1 class="display-4">Connect with Service Providers Instantly</h1>
        <p class="lead">Find trusted professionals for all your needs .</p>
        <div class="mt-4">
            <a href="#services" class="btn btn-primary btn-lg me-2">Read More</a>
            <a href="#" class="btn btn-outline-light btn-lg">Sign In</a>
        </div>
    </div>
</div>
 <i class="fas fa-star"></i>
                <h5>Trust and Quality</h5>
                <p>We prioritize transparency and high-quality services.</p>
            </div>
        </div>
       
    </div>
</div>

@endsection