@extends('layouts.guest')

@section('content')
    <div class="text-center mb-4">
        <i class="bi bi-key text-primary" style="font-size: 3rem;"></i>
        <h4 class="mt-3">Lupa Password</h4>
        <p class="text-muted small">Masukkan email Anda untuk menerima link reset password</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary-custom">
                Kirim Link Reset Password
            </button>
        </div>
        
        <hr class="my-4">
        
        <p class="text-center text-muted small">
            <a href="{{ route('login') }}" class="text-decoration-none">Kembali ke Login</a>
        </p>
    </form>
@endsection
