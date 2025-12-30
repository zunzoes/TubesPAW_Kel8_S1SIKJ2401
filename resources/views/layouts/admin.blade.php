<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Apparify')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #FCF8EE; /* Warna #5 */
        }
        .sidebar {
            min-height: 100vh;
            background: #6096B4; /* Warna #1 */
            color: #FCF8EE; /* Warna #5 */
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        }
        .sidebar .nav-link {
            color: rgba(252, 248, 238, 0.8); /* Warna #5 dengan transparansi */
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s;
            font-size: 0.95rem;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #93BFCF; /* Warna #2 */
            color: white !important;
        }
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        .main-content {
            background-color: #FCF8EE; /* Warna #5 */
            min-height: 100vh;
        }
        .navbar-admin {
            background: #EEE9DA; /* Warna #4 */
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border-bottom: 1px solid #BDCDD6; /* Warna #3 */
        }
        .card {
            border: 1px solid #BDCDD6; /* Warna #3 */
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
            background-color: white;
        }
        /* Penyesuaian teks dashboard judul agar serasi */
        .navbar-admin h5 {
            color: #6096B4; /* Warna #1 */
            font-weight: bold;
        }
        .btn-link {
            text-decoration: none;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-md-block sidebar p-3">
                <div class="d-flex flex-column align-items-center mb-4 py-3 border-bottom" style="border-color: rgba(238, 233, 218, 0.2) !important;">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mb-2 shadow-sm" style="width: 55px; height: 55px;">
                        <i class="fas fa-tshirt fa-lg" style="color: #6096B4;"></i>
                    </div>
                    <h4 class="text-white fw-bold mb-0" style="letter-spacing: 1.5px;">Apparify</h4>
                    <span class="badge mt-2" style="background-color: #EEE9DA; color: #6096B4; font-size: 0.65rem; letter-spacing: 1px; padding: 0.4em 0.8em;">ADMIN PANEL</span>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                            <i class="fas fa-list"></i> Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                            <i class="fas fa-box"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                            <i class="fas fa-shopping-cart"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.chats.*') ? 'active' : '' }}" href="{{ route('admin.chats.index') }}">
                            <i class="fas fa-comments"></i> Chats
                        </a>
                    </li>
                </ul>

                <div class="mt-5 pt-5">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-start w-100 border-0" style="color: rgba(252, 248, 238, 0.7);">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </nav>

            <main class="col-md-10 ms-sm-auto px-md-4 main-content">
                <nav class="navbar navbar-admin navbar-expand-lg mb-4 mt-2 rounded-3">
                    <div class="container-fluid">
                        <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
                        <div class="d-flex align-items-center">
                            <div class="bg-white rounded-pill px-3 py-1 border shadow-sm d-flex align-items-center">
                                <i class="fas fa-user-circle me-2 text-muted"></i>
                                <span class="fw-medium small text-dark">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </div>
                </nav>

                <div class="px-2">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                </div>

                <div class="py-2">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>