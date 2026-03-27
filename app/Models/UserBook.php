<?php

namespace App\Models;

use Database\Factories\UserBookFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBook extends Model
{
    /** @use HasFactory<UserBookFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status'
    ];

    public $timestamps = false;
}
