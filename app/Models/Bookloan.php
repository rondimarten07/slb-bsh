<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookloan extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'returned',
        'book_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }
}
