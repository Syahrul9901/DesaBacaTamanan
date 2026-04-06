@extends('layouts.guest')

@section('content')
    <div class="text-center mb-4">
        <i class="bi bi-envelope-check text-primary" style="font-size: 3rem;"></i>
        <h4 class="mt-3">Verifikasi Email</h4>
        <p class="text-muted small">Link verifikasi telah dikirim ke email Anda</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4">
            Link verifikasi baru telah dikirim ke email Anda.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div class="d-grid">
            <button type="submit" class="btn btn-primary-custom">
                Kirim Ulang Email Verifikasi
            </button>
        </div>
    </form>

    <hr class="my-4">

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="text-center">
            <button type="submit" class="btn btn-link text-decoration-none">
                Keluar
            </button>
        </div>
    </form>
@endsection
