@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-book"></i> Daftar Buku Tersedia</h4>
    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row g-4">
    @forelse($books as $book)
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if($book->cover_url)
                            <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" class="img-fluid rounded" style="max-height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 150px;">
                                <i class="bi bi-book text-muted fs-1"></i>
                            </div>
                        @endif
                    </div>
                    <h6 class="fw-bold">{{ $book->title }}</h6>
                    <p class="text-muted small mb-2">{{ $book->author }}</p>
                    <p class="text-muted small">
                        <i class="bi bi-building"></i> {{ $book->publisher ?: '-' }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success">Tersedia ({{ $book->stock }})</span>
                    </div>
                    
                    @if($book->stock > 0)
                        <button type="button" class="btn btn-primary-custom btn-sm w-100 mt-3" data-bs-toggle="modal" data-bs-target="#borrowModal{{ $book->id }}">
                            <i class="bi bi-bookmark-plus"></i> Pinjam
                        </button>
                    @else
                        <button class="btn btn-secondary btn-sm w-100 mt-3" disabled>
                            <i class="bi bi-x-circle"></i> Stok Habis
                        </button>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Borrow Modal -->
        @if($book->stock > 0)
            <div class="modal fade" id="borrowModal{{ $book->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pinjam Buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('user.borrow', $book->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <p><strong>{{ $book->title }}</strong></p>
                                <p class="text-muted">oleh {{ $book->author }}</p>
                                
                                <div class="mb-3">
                                    <label for="borrow_date" class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="borrow_date" name="borrow_date" value="{{ date('Y-m-d') }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="due_date" class="form-label">Tanggal Jatuh Tempo <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Catatan</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2" placeholder="Opsional"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary-custom">Pinjam</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="bi bi-book text-muted fs-1"></i>
                    <p class="text-muted mt-3">Tidak ada buku yang tersedia saat ini.</p>
                </div>
            </div>
        </div>
    @endforelse
</div>
@endsection
