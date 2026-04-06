<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'isbn',
        'description',
        'stock',
        'cover_image',
        'cover_file',
        'status',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function isAvailable()
    {
        return $this->status === 'available' && $this->stock > 0;
    }

    public function getCoverUrlAttribute()
    {
        // Prioritize uploaded file over URL
        if ($this->cover_file && File::exists(public_path('covers/' . $this->cover_file))) {
            return asset('covers/' . $this->cover_file);
        }
        return $this->cover_image;
    }
}
