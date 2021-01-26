<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'product',
        'quantity',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product');
    }
}
