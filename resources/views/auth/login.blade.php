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
        body {
            background: linear-gradient(135deg, var(--light-blue) 0%, #fff 100%);
            min-height: 100vh;
        }
        .bg-primary-custom {
            background-color: var(--primary-blue) !important;
        }
        .btn-primary-custom {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            color: white;
            padding: 10px 25px;
            font-weight: 500;
            border-radius: 8px;
        }
        .btn-primary-custom:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
        }
        .btn-outline-primary-custom {
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
            padding: 10px 25px;
            font-weight: 500;
            border-radius: 8px;
        }
        .btn-outline-primary-custom:hover {
            background-color: var(--primary-blue);
            color: white;
        }
        .login-container {
            max-width: 450px;
            margin: 50px auto;
        }
        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .card-header-custom {
            background: transparent;
            border-bottom: none;
            padding-bottom: 0;
        }
        .form-control {
            padding: 12px 15px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
        }
        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }
        @media (max-width: 576px) {
            .login-container {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="card card-custom">
                <div class="card-body p-4">
                    <!-- Logo & Title -->
                    <div class="text-center mb-4">
                        <a href="{{ route('home') }}" class="text-decoration-none">
                            <i class="bi bi-book text-primary" style="font-size: 3rem;"></i>
                        </a>
                        <h4 class="fw-bold mt-3 text-primary">DESA BACA TAMANAN</h4>
                        <p class="text-muted small">Masuk ke akun Anda</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-envelope text-muted"></i>
                                </span>
                                <input id="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                                       placeholder="nama@email.com">
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-lock text-muted"></i>
                                </span>
                                <input id="password" type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="current-password" 
                                       placeholder="••••••••">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label for="remember_me" class="form-check-label text-muted">Ingat saya</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none small text-primary">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-custom btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i> Masuk
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <!-- Register Link -->
                    <p class="text-center text-muted mb-0">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-decoration-none text-primary fw-medium">
                            Daftar sekarang
                        </a>
                    </p>

                    <!-- Back to Home -->
                    <div class="text-center mt-3">
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted small">
                            <i class="bi bi-arrow-left"></i> Kembali ke beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
