<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_code_id',
        'title',
        'description',
        'year',
        'publisher',
        'category_id',
    ];

    // Relasi One To One
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function bookCode()
    {
        return $this->belongsTo(BookCode::class);
    }
}
