<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            return redirect('/dashboard')->with('error', 'Akses ditolak!');
        }

        $totalBooks = Book::count();
        $availableBooks = Book::where('status', 'available')->sum('stock');
        $unavailableBooks = Book::where('status', 'unavailable')->count();
        
        return view('admin.dashboard', compact('totalBooks', 'availableBooks', 'unavailableBooks'));
    }

    public function booksIndex()
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            return redirect('/dashboard')->with('error', 'Akses ditolak!');
        }

        $books = Book::orderBy('created_at', 'desc')->get();
        return view('admin.books.index', compact('books'));
    }

    public function booksCreate()
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            return redirect('/dashboard')->with('error', 'Akses ditolak!');
        }

        return view('admin.books.create');
    }

    public function booksStore(Request $request)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            return redirect('/dashboard')->with('error', 'Akses ditolak!');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'cover_image' => 'nullable|string|max:255',
            'cover_file' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $validated['status'] = $validated['stock'] > 0 ? 'available' : 'unavailable';

        
        // Handle file upload
        if ($request->hasFile('cover_file')) {
            $file = $request->file('cover_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('covers'), $filename);
            $validated['cover_file'] = $filename;
        }

        Book::create($validated);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function booksEdit(Book $book)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            return redirect('/dashboard')->with('error', 'Akses ditolak!');
        }

        return view('admin.books.edit', compact('book'));
    }

    public function booksUpdate(Request $request, Book $book)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            return redirect('/dashboard')->with('error', 'Akses ditolak!');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'cover_image' => 'nullable|string|max:255',
            'cover_file' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $validated['status'] = $validated['stock'] > 0 ? 'available' : 'unavailable';

        // Handle file upload
        if ($request->hasFile('cover_file')) {
            // Delete old file if exists
            if ($book->cover_file && file_exists(public_path('covers/' . $book->cover_file))) {
                unlink(public_path('covers/' . $book->cover_file));
            }
            
            $file = $request->file('cover_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('covers'), $filename);
            $validated['cover_file'] = $filename;
        }

        $book->update($validated);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function booksDestroy(Book $book)
    {
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            return redirect('/dashboard')->with('error', 'Akses ditolak!');
        }

        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
