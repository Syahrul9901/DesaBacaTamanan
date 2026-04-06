<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DESA BACA TAMANAN') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-blue: #0d6efd;
            --primary-dark: #0a58ca;
            --secondary-blue: #6ea8fe;
            --light-blue: #e2eafc;
        }
        .bg-primary-custom {
            background-color: var(--primary-blue) !important;
        }
        .btn-primary-custom {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
        }
        .btn-primary-custom:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            width: 250px;
        }
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            display: none;
        }
        .sidebar-overlay.active {
            display: block;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }
        .card-header {
            background-color: white;
            border-bottom: 2px solid var(--light-blue);
            font-weight: 600;
        }
        .table th {
            background-color: var(--light-blue);
            font-weight: 600;
        }
        .input-group .btn {
            pointer-events: auto;
            z-index: 1;
        }
        .mobile-header {
            display: none;
        }
        
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                width: 80%;
                max-width: 280px;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .mobile-header {
                display: flex;
                background: linear-gradient(180deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
                padding: 15px;
                color: white;
                align-items: center;
                justify-content: space-between;
            }
            main {
                margin-top: 60px;
            }
            .table-responsive {
                font-size: 0.85rem;
            }
            .table-responsive .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
        }
        
        @media (min-width: 992px) {
            main {
                margin-left: 250px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        @auth
            <div class="mobile-header">
                <button class="btn btn-light btn-sm" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <span class="fw-bold">DESA BACA</span>
                <div style="width: 40px;"></div>
            </div>
            
            <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
            
            @if(Auth::user()->is_admin == 1)
                @include('layouts.sidebar')
            @else
                @include('layouts.user-sidebar')
            @endif
            
            <main class="p-0">
                <div class="container-fluid py-4 px-3 px-md-4">
                    @yield('content')
                </div>
            </main>
        @else
            <main class="p-0">
                @yield('content')
            </main>
        @endauth
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        }
    </script>
    @yield('scripts')
</body>
</html>