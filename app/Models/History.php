<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class, 'product');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }
    // public function getPaginated()
    // {
    //     return $this->product()->user()->paginate(15);
    // }
}
