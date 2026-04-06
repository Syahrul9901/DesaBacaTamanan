<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['nis', 'name', 'email', 'class', 'phone', 'address', 'gender', 'birth_date'];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
