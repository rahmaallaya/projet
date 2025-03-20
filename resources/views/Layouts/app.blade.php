<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Navbar Styles */
        .navbar {
            background-color: #f8f9fa !important;
            /*background-color: #2c3e50 !important;*/
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding : 10px;
            
        }

        /*.navbar .navbar-brand,
        .navbar .nav-link {
            color: #ffffff !important;
        }

        .navbar .nav-link:hover {
            color: #ecf0f1 !important;
        }

        .navbar .nav-item.active .nav-link {
            font-weight: bold;
            color: #3498db !important;
        }

        .navbar .dropdown-menu {
            background-color: #2c3e50;
        }

        .navbar .dropdown-item {
            color: #ffffff;
        }

        .navbar .dropdown-item:hover {
            background-color: #34495e;
        }
*/
        /* Main Content Padding */
        main {
            padding-top: 60px;
           
        }

        .contact-card {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height: 100%; /* Tous les rectangles ont la même hauteur */
        display: flex;
        flex-direction: column;
    }

    .contact-card h3 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #3498db;
    }

    .contact-card p {
        font-size: 1rem;
        color: #666;
        margin-bottom: 20px;
    }

    .contact-card a {
        color: #3498db;
        text-decoration: none;
    }

    .contact-card a:hover {
        text-decoration: underline;
    }

    .contact-card iframe {
        width: 100%;
        height: 300px; /* Hauteur fixe pour la carte */
        border: 0;
        border-radius: 8px;
    }

    .contact-card form label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    .contact-card form input,
    .contact-card form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .contact-card form button {
        background-color: #3498db;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .contact-card form button:hover {
        background-color: #2980b9;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">My Application</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('services.corporate.list') }}">Corporate Services</a></li>
                        <li><a class="dropdown-item" href="{{ route('services.individual.list') }}">Individual Services</a></li>
                            <li><a class="dropdown-item" href="#">AI Services</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Request List</a>
                    </li>
                  
                    <li class="nav-item">
                        <a class="nav-link" href="#">User Approvals</a>
                    </li>
                  
                    <li class="nav-item">
                        <a class="nav-link" href="#">Information Requests</a>
                    </li>
                  

                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-2"></i>
                                name
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <span class="dropdown-item-text small">
                                        Logged in as<br>
                                        <strong>email</strong>
                                    </span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-pencil-square me-2"></i>Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="#">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="#">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-light mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6">
                    <h5>About My Application</h5>
                    <p>My Application is your gateway to seamless service connections. We offer a wide range of services to meet your needs.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-light">Home</a></li>
                        <li><a href="#about" class="text-light">About</a></li>
                        <li><a href="#services" class="text-light">Services</a></li>
                        <li><a href="#" class="text-light">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li>Email: info@myapplication.com</li>
                        <li>Phone: +123 456 7890</li>
                        <li>Address: 123 Service Street, Service City</li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>&copy; {{ date('Y') }} My Application. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>