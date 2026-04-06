@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-arrow-left-right"></i> Kelola Peminjaman</h4>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Jatuh Tempo</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $index => $borrowing)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $borrowing->user->name }}</strong>
                                <br><small class="text-muted">{{ $borrowing->user->email }}</small>
                            </td>
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
                            <td>
                                <div class="btn-group" role="group">
                                    @if($borrowing->status === 'pending')
                                        <form action="{{ route('admin.borrowings.approve', $borrowing->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Setuju">
                                                <i class="bi bi-check"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $borrowing->id }}" title="Tolak">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    @endif
                                    
                                    @if(in_array($borrowing->status, ['approved', 'overdue']))
                                        <form action="{{ route('admin.borrowings.return', $borrowing->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary" title="Kembalikan">
                                                <i class="bi bi-arrow-return-left"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Reject Modal -->
                        <div class="modal fade" id="rejectModal{{ $borrowing->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tolak Peminjaman</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.borrowings.reject', $borrowing->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menolak peminjaman ini?</p>
                                            <div class="mb-3">
                                                <label for="notes" class="form-label">Alasan Penolakan</label>
                                                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="text-muted mb-0">Belum ada peminjaman.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
