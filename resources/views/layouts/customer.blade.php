<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Apparify - Custom Apparel')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* Kombinasi warna identitas Apparify */
            --primary: #6096B4;
            --secondary: #93BFCF;
            --accent: #BDCDD6;
            --neutral: #EEE9DA;
            --bg-cream: #FCF8EE;
            --dark-text: #2C3333;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-cream);
            color: var(--dark-text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main { flex: 1; }

        /* Navbar Customization */
        .navbar {
            background: white !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 0.8rem 0;
            border-bottom: 2px solid var(--accent);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary) !important;
        }

        .nav-link {
            color: #555 !important;
            font-weight: 600;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s;
            border-radius: 8px;
            margin: 0 2px;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
            background-color: rgba(96, 150, 180, 0.1);
        }

        /* Ikon Profil Spesifik */
        .profile-icon-custom { color: var(--primary) !important; }

        .badge-cart {
            position: absolute;
            top: 0px;
            right: 0px;
            background: #E67E22; 
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
            border: 2px solid white;
        }

        /* Footer Styling Berwarna Gelap Rapi */
        footer {
            background-color: var(--dark-text) !important;
            border-top: 5px solid var(--primary);
            color: #bdc3c7;
        }

        footer h5 {
            color: white;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        footer .footer-link {
            color: #bdc3c7;
            text-decoration: none;
            transition: 0.3s;
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        footer .footer-link:hover {
            color: var(--primary);
            padding-left: 5px;
        }

        .social-icon {
            width: 35px;
            height: 35px;
            background: rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            margin-right: 10px;
            transition: 0.3s;
        }

        .social-icon:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('customer.dashboard') }}">
                {{-- Kode di bawah ini untuk memanggil file logo asli Anda --}}
                <img src="{{ asset('images/apparify-high-resolution-logo-transparent.png') }}" alt="Apparify Logo" style="height: 40px; width: auto;">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    {{-- Ikon Navigasi dihapus sesuai permintaan agar tampilan lebih minimalis --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}" href="{{ route('customer.dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.products.*') ? 'active' : '' }}" href="{{ route('customer.products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.orders.*') ? 'active' : '' }}" href="{{ route('customer.orders.index') }}">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.design.*') ? 'active' : '' }}" href="{{ route('customer.design.create') }}">Custom</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.chat.*') ? 'active' : '' }}" href="{{ route('customer.chat.index') }}">Chat</a>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item me-3">
                        <a class="nav-link position-relative px-2" href="{{ route('customer.cart.index') }}">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            @if(isset($cartCount) && $cartCount > 0)
                                <span class="badge-cart">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="bg-light rounded-circle p-1 me-2 d-inline-flex">
                                <i class="fas fa-user-circle fa-lg profile-icon-custom"></i>
                            </div>
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item py-2" href="{{ route('customer.dashboard') }}"><i class="fas fa-user-cog me-2"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger font-weight-bold"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" style="background-color: var(--primary); color: white;" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h4 class="text-white fw-bold mb-3">Apparify</h4>
                    <p class="small">Platform penyedia apparel custom berkualitas tinggi dengan desain yang bisa Anda tentukan sendiri.</p>
                    <div class="mt-4">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <h5>Quick Links</h5>
                    <a href="{{ route('customer.dashboard') }}" class="footer-link">Dashboard</a>
                    <a href="{{ route('customer.products.index') }}" class="footer-link">Cari Produk</a>
                    <a href="{{ route('customer.design.create') }}" class="footer-link">Custom Desain</a>
                </div>
                <div class="col-lg-2">
                    <h5>Support</h5>
                    <a href="{{ route('customer.chat.index') }}" class="footer-link">Hubungi Kami</a>
                    <a href="{{ route('customer.orders.index') }}" class="footer-link">Status Pesanan</a>
                    <a href="#" class="footer-link">FAQ</a>
                </div>
                <div class="col-lg-3">
                    <h5>Contact Us</h5>
                    {{-- Ikon diperbarui menggunakan var(--primary) agar berwarna #6096B4 sesuai instruksi --}}
                    <p class="small mb-2">
                        <i class="fas fa-map-marker-alt me-2" style="color: var(--primary)"></i> 
                        Depok, Jawa Barat, Indonesia
                    </p>
                    <p class="small mb-2">
                        <i class="fas fa-envelope me-2" style="color: var(--primary)"></i> 
                        support@apparify.com
                    </p>
                    <p class="small">
                        <i class="fas fa-phone me-2" style="color: var(--primary)"></i> 
                        +62 812 3456 7890
                    </p>
                </div>
            </div>
            <hr class="my-4 opacity-25">
            <div class="text-center small">
                <p class="mb-0">&copy; {{ date('Y') }} <strong>Apparify</strong>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>