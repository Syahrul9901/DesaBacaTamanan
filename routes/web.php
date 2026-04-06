<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Landing page - redirect based on auth status
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
    return view('welcome');
})->name('home');

// Dashboard redirect based on user role
Route::get('/dashboard', function () {
    if (Auth::user()->is_admin == 1) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Book management
    Route::get('/admin/books', [AdminController::class, 'booksIndex'])->name('admin.books.index');
    Route::get('/admin/books/create', [AdminController::class, 'booksCreate'])->name('admin.books.create');
    Route::post('/admin/books', [AdminController::class, 'booksStore'])->name('admin.books.store');
    Route::get('/admin/books/{book}/edit', [AdminController::class, 'booksEdit'])->name('admin.books.edit');
    Route::put('/admin/books/{book}', [AdminController::class, 'booksUpdate'])->name('admin.books.update');
    Route::delete('/admin/books/{book}', [AdminController::class, 'booksDestroy'])->name('admin.books.destroy');
    
    // Borrowing management
    Route::get('/admin/borrowings', [BorrowingController::class, 'index'])->name('admin.borrowings.index');
    Route::post('/admin/borrowings/{borrowing}/approve', [BorrowingController::class, 'approve'])->name('admin.borrowings.approve');
    Route::post('/admin/borrowings/{borrowing}/reject', [BorrowingController::class, 'reject'])->name('admin.borrowings.reject');
    Route::post('/admin/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('admin.borrowings.return');
    
    // Category management
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    
    // Member management
    Route::get('/admin/members', [MemberController::class, 'index'])->name('admin.members.index');
    Route::get('/admin/members/create', [MemberController::class, 'create'])->name('admin.members.create');
    Route::post('/admin/members', [MemberController::class, 'store'])->name('admin.members.store');
    Route::get('/admin/members/{member}/edit', [MemberController::class, 'edit'])->name('admin.members.edit');
    Route::put('/admin/members/{member}', [MemberController::class, 'update'])->name('admin.members.update');
    Route::delete('/admin/members/{member}', [MemberController::class, 'destroy'])->name('admin.members.destroy');
    
    // User management
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// User routes
Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [BorrowingController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('user.profile');
    Route::get('/user/books/available', [BorrowingController::class, 'availableBooks'])->name('user.books.available');
    Route::post('/user/books/{book}/borrow', [BorrowingController::class, 'borrow'])->name('user.borrow');
    Route::get('/user/borrowings', [BorrowingController::class, 'myBorrowings'])->name('user.borrowings');
    Route::delete('/user/borrowings/{borrowing}', [BorrowingController::class, 'cancelBorrowing'])->name('user.borrowings.cancel');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
