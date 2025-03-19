@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    .home-page {
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
        margin-top: 0px; 
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
    
<<<<<<< Updated upstream
/*doraaa*/
    /* Agrandir le navbar */
=======

>>>>>>> Stashed changes
    .navbar-nav .nav-link {
        font-size: 1.2rem; 
    }
    .service-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 90px;
        padding: 0;
    }

    .service-item {
        background: #f0f8ff;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 300px;
        position: relative;
        overflow: hidden;
        width: 300px;
    }

    .service-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 10px;
        background: #87CEEB; /* Bande bleue en haut */
        z-index: 1;
    }

    .service-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        background: #e0f7ff; /* Couleur de fond au survol (bleu très clair) */
    }

    .service-item i {
        font-size: 3rem;
        color: #3498db; /* Couleur des icônes (bleu) */
        margin-bottom: 15px;
        transition: color 0.3s ease;
    }

    .service-item h5 {
        color: #333; /* Couleur du titre */
        font-size: 1.25rem;
        margin-bottom: 10px;
        transition: color 0.3s ease;
    }

    .service-item p {
        color: #666; /* Couleur du texte */
        font-size: 1rem;
        transition: color 0.3s ease;
    }

    /* Styles pour la section About */
    #about {
        background-color: #ffffff; /* Fond blanc */
        padding: 6rem; /* Espacement interne accru */
    }

    #about .about-title {
        font-size: 2.5rem; /* Taille du titre */
        font-weight: bold;
        color: #333; /* Couleur du texte */
        margin-bottom: 1rem;
        text-transform: uppercase; /* Texte en majuscules */
    }

    #about .about-subtitle {
        font-size: 1.5rem; /* Taille du sous-titre */
        color: #3498db; /* Couleur bleue pour le sous-titre */
        margin-bottom: 1.5rem;
        font-weight: 500; /* Poids de la police */
    }

    #about .about-text {
        font-size: 1rem; /* Taille du texte */
        color: #666; /* Couleur du texte */
        line-height: 1.8; /* Hauteur de ligne */
        margin-bottom: 1.5rem;
    }

    #about img {
        border-radius: 10px; /* Coins arrondis pour l'image */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre légère */
        max-width: 100%; /* Assure que l'image ne dépasse pas son conteneur */
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
<div id="about" class="container-fluid py-5">
    <div class="row align-items-center">
  
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/about.jpg') }}" alt="About Us" class="img-fluid" style="max-width: 70%;">
        </div>
       
        <div class="col-md-6">
            <h2 class="about-title">ABOUT US</h2>
            <p class="about-subtitle">Welcome to My Application</p>
            <p class="about-text">Learn more about [Platform Name] and our mission to provide quality services.</p>
            <p class="about-text">My Application is dedicated to helping individuals and businesses find reliable professionals for a wide range of services. Whether you need our platform makes it easy to connect with trusted providers.</p>
        </div>
    </div>
</div>
</div>
<div id="services" class="container-xxl py-5">
    <div class="container">
        <div class="service-container">
      
            <div class="service-item wow fadeInUp" data-wow-delay="0.1s">
                <i class="fas fa-list-alt"></i>
                <h5>Diverse Services</h5>
                <p>We offer a wide range of services to meet your needs.</p>
            </div>
          
            <div class="service-item wow fadeInUp" data-wow-delay="0.3s">
            <i class="fas fa-handshake fa-3x"></i>
                <h5>Flexible Providers</h5>
                <p>Connect with professionals or AI solutions tailored to you.</p>
            </div>
           
            <div class="service-item wow fadeInUp" data-wow-delay="0.5s">
                <i class="fas fa-user-friends"></i>
                <h5>User-Friendly Experience</h5>
                <p>Our platform is intuitive and easy to use.</p>
            </div>
            
            <div class="service-item wow fadeInUp" data-wow-delay="0.7s">
                <i class="fas fa-star"></i>
                <h5>Trust and Quality</h5>
                <p>We prioritize transparency and high-quality services.</p>
            </div>
        </div>
       
    </div>
</div>

@endsection