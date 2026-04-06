@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h4 class="fw-bold"><i class="bi bi-speedometer2"></i> Dashboard Admin</h4>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-0">Total Buku</p>
                        <h2 class="mb-0 fw-bold text-primary">{{ $totalBooks }}</h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <i class="bi bi-book text-primary fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-0">Buku Tersedia</p>
                        <h2 class="mb-0 fw-bold text-success">{{ $availableBooks }}</h2>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <i class="bi bi-check-circle text-success fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-0">Buku Tidak Tersedia</p>
                        <h2 class="mb-0 fw-bold text-danger">{{ $unavailableBooks }}</h2>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded">
                        <i class="bi bi-x-circle text-danger fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Selamat datang di dashboard admin. Silakan gunakan menu di sidebar untuk mengelola buku dan peminjaman.</p>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-book"></i> Kelola Buku
                    </a>
                    <a href="{{ route('admin.borrowings.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left-right"></i> Kelola Peminjaman
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
