<?php

namespace App\Models;

use Database\Factories\BookUserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    /** @use HasFactory<BookUserFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'book_user';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'status',
    ];
}
