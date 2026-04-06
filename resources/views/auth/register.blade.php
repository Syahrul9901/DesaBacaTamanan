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
        .login-container {
            max-width: 450px;
            margin: 50px auto;
        }
        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
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
                        <p class="text-muted small">Buat akun baru</p>
                    </div>

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

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-person text-muted"></i>
                                </span>
                                <input id="name" type="text" class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                                       placeholder="Nama lengkap Anda">
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-envelope text-muted"></i>
                                </span>
                                <input id="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="username" 
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
                                       name="password" required autocomplete="new-password" 
                                       placeholder="••••••••">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-medium">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-lock-fill text-muted"></i>
                                </span>
                                <input id="password_confirmation" type="password" class="form-control border-start-0 @error('password_confirmation') is-invalid @enderror" 
                                       name="password_confirmation" required autocomplete="new-password" 
                                       placeholder="••••••••">
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary-custom btn-lg">
                                <i class="bi bi-person-plus"></i> Daftar
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <!-- Login Link -->
                    <p class="text-center text-muted mb-0">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-medium">
                            Masuk di sini
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
