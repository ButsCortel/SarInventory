<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $casts = [
        'checkouts' => 'array',
    ];
    //does not work, can't display related data on blade. why tho
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user', 'id');
    // }
}
