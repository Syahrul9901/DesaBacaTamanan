<div class="sidebar p-3">
    <div class="d-flex justify-content-between align-items-center mb-4 d-lg-none">
        <span class="text-white fw-bold">DESA BACA</span>
        <button class="btn btn-sm text-white" onclick="toggleSidebar()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    
    <div class="text-center mb-4 d-none d-lg-block">
        <a href="{{ route('user.dashboard') }}" class="text-decoration-none">
            <h5 class="text-white"><i class="bi bi-book-fill"></i> DESA BACA</h5>
            <small class="text-white-50">TAMANAN</small>
        </a>
    </div>
    
    <!-- User Info -->
    <div class="text-center mb-4 pb-3 border-bottom border-white">
        <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
            <i class="bi bi-person-fill text-primary fs-4"></i>
        </div>
        <p class="text-white mb-0 fw-bold">{{ Auth::user()->name }}</p>
        <small class="text-white-50">Anggota</small>
    </div>
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white rounded py-2" href="{{ route('user.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> <span class="d-none d-lg-inline">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white rounded py-2" href="{{ route('user.books.available') }}">
                <i class="bi bi-book me-2"></i> <span class="d-none d-lg-inline">Buku Tersedia</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white rounded py-2" href="{{ route('user.borrowings') }}">
                <i class="bi bi-arrow-left-right me-2"></i> <span class="d-none d-lg-inline">Peminjaman Saya</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white rounded py-2" href="{{ route('user.profile') }}">
                <i class="bi bi-person-circle me-2"></i> <span class="d-none d-lg-inline">Profil Saya</span>
            </a>
        </li>
    </ul>
    
    <div class="mt-auto pt-4">
        <ul class="nav flex-column">
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link text-white btn btn-link text-decoration-none w-100 text-start rounded py-2">
                        <i class="bi bi-box-arrow-right me-2"></i> <span class="d-none d-lg-inline">Keluar</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

<style>
.sidebar .nav-link:hover {
    background-color: rgba(255,255,255,0.2) !important;
}
.sidebar .nav-link {
    display: flex;
    align-items: center;
}
</style>