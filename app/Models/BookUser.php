<?php

namespace App\Models;

use Database\Factories\BookUserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    /** @use HasFactory<BookUserFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
    ];

    public $timestamps = false;
}
