@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-plus-circle"></i> Tambah Buku</h4>
    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="title" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="author" class="form-label">Penulis <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author') }}" required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="publisher" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher') }}">
                </div>
                
                <div class="col-md-6">
                    <label for="isbn" class="form-label">ISBN</label>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}">
                        <button type="button" class="btn btn-outline-primary btn-sm px-3" onclick="generateISBN()" title="Generate ISBN" style="pointer-events: auto;">
                            <i class="bi bi-arrow-repeat"></i>
                        </button>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', 1) }}" min="0" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="cover_image" class="form-label">URL Cover Buku</label>
                    <input type="url" class="form-control" id="cover_image" name="cover_image" value="{{ old('cover_image') }}" placeholder="https://example.com/cover.jpg">
                </div>
                
                <div class="col-md-6">
                    <label for="cover_file" class="form-label">Upload Cover Buku</label>
                    <input type="file" class="form-control" id="cover_file" name="cover_file" accept="image/*">
                    <small class="text-muted">Max: 2MB (JPG, PNG, GIF)</small>
                </div>
                
                <div class="col-12">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
function generateISBN() {
    // Generate a random 13-digit ISBN
    let isbn = '978';
    for (let i = 0; i < 9; i++) {
        isbn += Math.floor(Math.random() * 10);
    }
    
    // Calculate check digit
    let sum = 0;
    for (let i = 0; i < 12; i++) {
        sum += parseInt(isbn[i]) * (i % 2 === 0 ? 1 : 3);
    }
    let checkDigit = (10 - (sum % 10)) % 10;
    isbn += checkDigit;
    
    document.getElementById('isbn').value = isbn;
}
</script>
