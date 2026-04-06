<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DESA BACA TAMANAN') }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-blue: #0d6efd;
            --primary-dark: #0a58ca;
            --light-blue: #e7f1ff;
        }
        .bg-primary-custom {
            background-color: var(--primary-blue) !important;
        }
        .btn-primary-custom {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            color: white;
            padding: 12px 30px;
            font-weight: 500;
            border-radius: 50px;
        }
        .btn-primary-custom:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
        }
        .btn-outline-custom {
            border: 2px solid white;
            color: white;
            padding: 12px 30px;
            font-weight: 500;
            border-radius: 50px;
        }
        .btn-outline-custom:hover {
            background-color: white;
            color: var(--primary-blue);
        }
        .hero-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 60px 0;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 80%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(45deg);
        }
        .card-custom {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }
        .feature-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--light-blue);
            color: var(--primary-blue);
            font-size: 1.8rem;
        }
        .book-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        .book-card:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .book-card img {
            height: 200px;
            object-fit: cover;
        }
        .stats-section {
            background: var(--light-blue);
        }
        .nav-link-custom {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 20px;
            transition: all 0.3s;
        }
        .nav-link-custom:hover {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .navbar-brand {
            font-size: 1.2rem;
        }
        
        /* Responsive Styles */
        @media (max-width: 991px) {
            .hero-section {
                min-height: auto;
                padding: 100px 0 60px;
            }
            .hero-section h1 {
                font-size: 1.8rem;
            }
            .hero-section p {
                font-size: 1rem;
            }
            .card-custom {
                margin-top: 30px;
                padding: 20px;
            }
            .feature-icon {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }
            .navbar-collapse {
                background: var(--primary-blue);
                padding: 15px;
                border-radius: 10px;
                margin-top: 10px;
            }
            .nav-link-custom {
                display: block;
                padding: 10px 15px;
            }
            .btn-lg {
                padding: 10px 20px;
                font-size: 1rem;
            }
        }
        
        @media (max-width: 767px) {
            .hero-section h1 {
                font-size: 1.5rem;
            }
            .feature-card h5 {
                font-size: 1rem;
            }
            .book-card img {
                height: 150px;
            }
            .stats-section h2 {
                font-size: 1.5rem;
            }
            .section-title {
                font-size: 1.3rem;
            }
        }
        
        @media (max-width: 480px) {
            .hero-section {
                padding: 80px 0 40px;
            }
            .btn-primary-custom, .btn-outline-custom {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
            .d-flex.gap-3 {
                flex-direction: column;
            }
            .d-flex.gap-3 .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    @auth
        <!-- Navbar for logged in users -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary-custom">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                    <i class="bi bi-book"></i> DESA BACA TAMANAN
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.books.index') }}">
                                <i class="bi bi-book"></i> Kelola Buku
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.books.available') }}">
                                <i class="bi bi-book"></i> Daftar Buku
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.borrowings') }}">
                                <i class="bi bi-arrow-left-right"></i> Peminjaman
                            </a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <span class="dropdown-item-text text-muted">
                                        <small>{{ Auth::user()->isAdmin() ? 'Administrator' : 'Pengguna' }}</small>
                                    </span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right"></i> Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- User Dashboard Content -->
        <div class="container py-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <h2 class="fw-bold">Halo, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-muted">Selamat datang di DESA BACA TAMANAN</p>
                </div>
            </div>
            
            <div class="row g-4">
                @if(Auth::user()->isAdmin())
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-speedometer2 text-primary fs-1"></i>
                            <h5 class="mt-3">Dashboard Admin</h5>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary-custom mt-2">Buka</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-book text-primary fs-1"></i>
                            <h5 class="mt-3">Kelola Buku</h5>
                            <a href="{{ route('admin.books.index') }}" class="btn btn-primary-custom mt-2">Buka</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-arrow-left-right text-primary fs-1"></i>
                            <h5 class="mt-3">Peminjaman</h5>
                            <a href="{{ route('admin.borrowings.index') }}" class="btn btn-primary-custom mt-2">Buka</a>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-speedometer2 text-primary fs-1"></i>
                            <h5 class="mt-3">Dashboard</h5>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-primary-custom mt-2">Buka</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-book text-primary fs-1"></i>
                            <h5 class="mt-3">Daftar Buku</h5>
                            <a href="{{ route('user.books.available') }}" class="btn btn-primary-custom mt-2">Buka</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-arrow-left-right text-primary fs-1"></i>
                            <h5 class="mt-3">Peminjaman Saya</h5>
                            <a href="{{ route('user.borrowings') }}" class="btn btn-primary-custom mt-2">Buka</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    @else
        <!-- Navbar for guests -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-absolute w-100" style="z-index: 100;">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">
                    <i class="bi bi-book"></i> DESA BACA
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="#fitur">Fitur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="#buku">Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="{{ route('login') }}">Masuk</a>
                        </li>
                        <li class="nav-item mt-2 mt-lg-0">
                            <a class="btn btn-light text-primary" href="{{ route('register') }}">Daftar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-white">
                        <h1 class="fw-bold mb-4" style="font-size: 3rem; line-height: 1.2;">
                            Perpustakaan Digital<br>Desa Tamanan
                        </h1>
                        <p class="mb-4 fs-5" style="opacity: 0.9;">
                            Pinjam buku secara online dengan mudah. Kembangkan pengetahuan dan imajinasi Anda bersama DESA BACA TAMANAN.
                        </p>
                        <div class="d-flex gap-2 gap-md-3 flex-column flex-md-row">
                            <a href="{{ route('register') }}" class="btn btn-light text-primary btn-lg">
                                <i class="bi bi-person-plus"></i> Mulai Sekarang
                            </a>
                            <a href="#fitur" class="btn btn-outline-light btn-lg">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5 mt-lg-0">
                        <div class="card card-custom shadow-lg p-4">
                            <div class="text-center">
                                <i class="bi bi-book-half text-primary" style="font-size: 5rem;"></i>
                                <h3 class="mt-3 fw-bold">Selamat Datang</h3>
                                <p class="text-muted">Di sistem peminjaman buku online Desa Tamanan</p>
                                <div class="d-grid gap-2 mt-4">
                                    <a href="{{ route('login') }}" class="btn btn-primary-custom">
                                        <i class="bi bi-box-arrow-in-right"></i> Masuk
                                    </a>
                                    <a href="{{ route('register') }}" class="btn btn-outline-custom">
                                        <i class="bi bi-person-plus"></i> Daftar Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="fitur" class="py-5">
            <div class="container py-4 py-md-5">
                <div class="text-center mb-4 mb-md-5">
                    <h2 class="fw-bold section-title">Fitur Utama</h2>
                    <p class="text-muted">Nikmati kemudahan dalam peminjaman buku</p>
                </div>
                <div class="row g-3 g-md-4">
                    <div class="col-12 col-md-4">
                        <div class="card h-100 border-0 shadow-sm p-3 p-md-4 text-center feature-card">
                            <div class="feature-icon mx-auto mb-3 mb-md-4">
                                <i class="bi bi-book"></i>
                            </div>
                            <h5 class="fw-bold">Koleksi Buku Lengkap</h5>
                            <p class="text-muted mb-0">Akses berbagai koleksi buku dari berbagai genre dan penulis ternama</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card h-100 border-0 shadow-sm p-3 p-md-4 text-center feature-card">
                            <div class="feature-icon mx-auto mb-3 mb-md-4">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <h5 class="fw-bold">Pinjam 24/7</h5>
                            <p class="text-muted mb-0">Ajukan peminjaman kapan saja secara online tanpa batas waktu</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card h-100 border-0 shadow-sm p-3 p-md-4 text-center feature-card">
                            <div class="feature-icon mx-auto mb-3 mb-md-4">
                                <i class="bi bi-bell"></i>
                            </div>
                            <h5 class="fw-bold">Notifikasi Realtime</h5>
                            <p class="text-muted mb-0">Dapatkan notifikasi status peminjaman secara langsung</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section py-4 py-md-5">
            <div class="container py-3 py-md-4">
                <div class="row text-center">
                    <div class="col-6 col-md-3 mb-3 mb-md-0">
                        <h2 class="fw-bold text-primary">12+</h2>
                        <p class="mb-0">Buku Tersedia</p>
                    </div>
                    <div class="col-6 col-md-3 mb-3 mb-md-0">
                        <h2 class="fw-bold text-primary">100+</h2>
                        <p class="mb-0">Peminjaman</p>
                    </div>
                    <div class="col-6 col-md-3 mb-3 mb-md-0">
                        <h2 class="fw-bold text-primary">50+</h2>
                        <p class="mb-0">Anggota Aktif</p>
                    </div>
                    <div class="col-6 col-md-3">
                        <h2 class="fw-bold text-primary">24/7</h2>
                        <p class="mb-0">Layanan Online</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Books Preview -->
        <section id="buku" class="py-4 py-md-5">
            <div class="container py-3 py-md-5">
                <div class="text-center mb-4 mb-md-5">
                    <h2 class="fw-bold section-title">Buku Populer</h2>
                    <p class="text-muted">Koleksi buku yang paling banyak dipinjam</p>
                </div>
                <div class="row g-3 g-md-4">
                    <div class="col-6 col-md-3">
                        <div class="card book-card shadow-sm">
                            <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=400&fit=crop" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h6 class="mb-1">Laravel Pro</h6>
                                <small class="text-muted">Mohammad Safari</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card book-card shadow-sm">
                            <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=300&h=400&fit=crop" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h6 class="mb-1">PHP & MySQL</h6>
                                <small class="text-muted">Abdul Kadir</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card book-card shadow-sm">
                            <img src="https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=300&h=400&fit=crop" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h6 class="mb-1">JavaScript</h6>
                                <small class="text-muted">Douglas Crockford</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card book-card shadow-sm">
                            <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=300&h=400&fit=crop" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h6 class="mb-1">Clean Code</h6>
                                <small class="text-muted">Robert C. Martin</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4 mt-md-5">
                    <a href="{{ route('register') }}" class="btn btn-primary-custom">
                        Lihat Semua Buku <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-primary-custom py-4 py-md-5">
            <div class="container py-3 py-md-4">
                <div class="row align-items-center">
                    <div class="col-lg-8 text-white mb-3 mb-lg-0">
                        <h3 class="fw-bold mb-2">Siap Memulai Petualangan Membaca?</h3>
                        <p class="mb-0" style="opacity: 0.9;">Bergabunglah dengan komunitas pembaca DESA BACA TAMANAN hari ini</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('register') }}" class="btn btn-light text-primary btn-lg">
                            Daftar Sekarang <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-dark text-white py-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <small>&copy; 2026 DESA BACA TAMANAN. All rights reserved.</small>
                    </div>
                </div>
            </div>
        </footer>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>
