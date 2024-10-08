<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookshelfs extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'book_shelf_id');
    }
}
