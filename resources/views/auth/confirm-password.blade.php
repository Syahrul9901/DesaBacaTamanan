@extends('layouts.guest')

@section('content')
    <div class="text-center mb-4">
        <i class="bi bi-shield-lock text-primary" style="font-size: 3rem;"></i>
        <h4 class="mt-3">Konfirmasi Password</h4>
        <p class="text-muted small">Silakan konfirmasi password Anda sebelum melanjutkan</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" autofocus>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary-custom">
                Konfirmasi
            </button>
        </div>
    </form>
@endsection
