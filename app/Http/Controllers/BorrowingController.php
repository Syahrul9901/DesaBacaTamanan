<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function userDashboard()
    {
        $borrowings = Borrowing::where('user_id', Auth::id())
            ->with('book')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('user.dashboard', compact('borrowings'));
    }

    public function availableBooks()
    {
        $books = Book::where('status', 'available')
            ->where('stock', '>', 0)
            ->orderBy('title')
            ->get();
        
        return view('user.books.available', compact('books'));
    }

    public function borrow(Request $request, Book $book)
    {
        $user = Auth::user();
        
        if (!$user->is_complete) {
            return back()->with('error', 'Anda harus melengkapi profil (alamat dan nomor HP) terlebih dahulu untuk melakukan peminjaman!');
        }

        if ($book->stock <= 0 || $book->status === 'unavailable') {
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam!');
        }

        $existingBorrowing = Borrowing::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingBorrowing) {
            return back()->with('error', 'Anda sudah memesan buku ini!');
        }

        $request->validate([
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
            'notes' => 'nullable|string',
        ]);

        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrow_date' => $request->borrow_date,
            'due_date' => $request->due_date,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('user.borrowings')->with('success', 'Permintaan peminjaman berhasil dikirim!');
    }

    public function myBorrowings()
    {
        $borrowings = Borrowing::where('user_id', Auth::id())
            ->with('book')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('user.borrowings.index', compact('borrowings'));
    }

    public function cancelBorrowing(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id()) {
            return back()->with('error', 'Akses ditolak!');
        }

        if (!in_array($borrowing->status, ['pending', 'approved'])) {
            return back()->with('error', 'Peminjaman tidak dapat dibatalkan!');
        }

        $borrowing->delete();
        return back()->with('success', 'Peminjaman berhasil dibatalkan!');
    }

    // Admin methods
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.borrowings.index', compact('borrowings'));
    }

    public function approve(Borrowing $borrowing)
    {
        $borrowing->update(['status' => 'approved']);
        
        $book = $borrowing->book;
        $book->decrement('stock');
        if ($book->stock <= 0) {
            $book->update(['status' => 'unavailable']);
        }

        return back()->with('success', 'Peminjaman disetujui!');
    }

    public function reject(Request $request, Borrowing $borrowing)
    {
        $borrowing->update([
            'status' => 'rejected',
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Peminjaman ditolak!');
    }

    public function returnBook(Borrowing $borrowing)
    {
        $borrowing->update([
            'status' => 'returned',
            'return_date' => now(),
        ]);

        $book = $borrowing->book;
        $book->increment('stock');
        if ($book->stock > 0) {
            $book->update(['status' => 'available']);
        }

        return back()->with('success', 'Buku berhasil dikembalikan!');
    }
}
