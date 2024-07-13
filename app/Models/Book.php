<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function soldDetails()
{
    return $this->hasMany(SoldDetail::class);
}
protected $fillable = [
    'name', 'author', 'book_number', 'quantity', 'price',
];
}
