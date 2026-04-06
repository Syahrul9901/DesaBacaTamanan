@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-speedometer2"></i> Halo, {{ Auth::user()->name }} 👋</h4>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-0">Peminjaman Aktif</p>
                        <h2 class="mb-0 fw-bold text-primary">{{ $borrowings->whereIn('status', ['pending', 'approved'])->count() }}</h2>
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
                        <p class="text-muted mb-0">Sudah Dikembalikan</p>
                        <h2 class="mb-0 fw-bold text-success">{{ $borrowings->where('status', 'returned')->count() }}</h2>
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
                        <p class="text-muted mb-0">Menunggu Persetujuan</p>
                        <h2 class="mb-0 fw-bold text-warning">{{ $borrowings->where('status', 'pending')->count() }}</h2>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                        <i class="bi bi-hourglass-split text-warning fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="bi bi-book"></i> Daftar Buku Tersedia</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Lihat dan pinjam buku yang tersedia di perpustakaan.</p>
                <a href="{{ route('user.books.available') }}" class="btn btn-outline-primary">
                    <i class="bi bi-book"></i> Lihat Buku
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="bi bi-arrow-left-right"></i> Peminjaman Saya</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Lihat status peminjaman buku Anda.</p>
                <a href="{{ route('user.borrowings') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left-right"></i> Lihat Peminjaman
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Riwayat Peminjaman Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Jatuh Tempo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($borrowings->take(5) as $borrowing)
                                <tr>
                                    <td>{{ $borrowing->book->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($borrowing->due_date)->format('d/m/Y') }}</td>
                                    <td>
                                        @switch($borrowing->status)
                                            @case('pending')
                                                <span class="badge bg-warning">Menunggu</span>
                                                @break
                                            @case('approved')
                                                <span class="badge bg-info">Disetujui</span>
                                                @break
                                            @case('rejected')
                                                <span class="badge bg-danger">Ditolak</span>
                                                @break
                                            @case('returned')
                                                <span class="badge bg-success">Dikembalikan</span>
                                                @break
                                            @case('overdue')
                                                <span class="badge bg-dark">Terlambat</span>
                                                @break
                                        @endswitch
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <p class="text-muted mb-0">Belum ada peminjaman.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
