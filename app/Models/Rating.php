<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_id',
        'kurir_id',
        'user_id',
        'rating',
        'review',
    ];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function kurir()
    {
        return $this->belongsTo(User::class, 'kurir_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}