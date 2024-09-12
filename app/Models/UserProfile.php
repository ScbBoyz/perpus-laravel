<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'address',
        'phone',
    ];

    public function User()
    {
        return $this->hasOne(User::class);
    }
}
