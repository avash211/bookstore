<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoldDetail extends Model
{
    protected $fillable = [
        'date', 'guest_name', 'book_number', 'book_name', 'author_name',
        'price', 'quantity', 'payment_mode', 'discount', 'total', 'img'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_number', 'book_number');
    }
}
