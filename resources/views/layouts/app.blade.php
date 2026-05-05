<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventaris App</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #1a1d20 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.7) !important;
            transition: 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff !important;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-register {
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3">
        <div class="container">
            <!-- Brand di Kiri -->
            <a class="navbar-brand fw-bold fs-4" href="/">
                <i class="bi bi-box-seam-fill me-2 text-primary"></i>Inventaris App
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Semua menu didorong ke KANAN menggunakan ms-auto -->
                <ul class="navbar-nav ms-auto align-items-center gap-2">

                    @auth
                        <!-- Link Utama (Hanya muncul jika sudah login) -->
                        <li class="nav-item">
                            <a href="/" class="nav-link px-3 {{ request()->is('/') ? 'active' : '' }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="/products" class="nav-link px-3 {{ request()->is('products*') ? 'active' : '' }}">Data
                                Barang</a>
                        </li>

                        <!-- Akun Dropdown -->
                        <li class="nav-item dropdown ms-lg-3">
                            <a href="#"
                                class="nav-link dropdown-toggle d-flex align-items-center gap-2 bg-secondary bg-opacity-25 rounded-pill px-3"
                                id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle fs-5"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-2 mt-2">
                                <li>
                                    <h6 class="dropdown-header">Manajemen Akun</h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="dropdown-item text-danger d-flex align-items-center gap-2">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Logika Kondisional untuk Guest agar tidak redundant -->
                        @if (!request()->routeIs('login'))
                            <li class="nav-item">
                                <a class="btn btn-primary btn-register shadow-sm" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif

                        @if (!request()->routeIs('register'))
                            <li class="nav-item">
                                <a class="btn btn-primary btn-register shadow-sm" href="{{ route('register') }}">Daftar
                                    Akun</a>
                            </li>
                        @endif
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        @yield('content')
    </main>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
