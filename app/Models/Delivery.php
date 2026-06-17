<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'kurir_id',
        'address',
        'phone',
        'status',
        'notes',
        'delivered_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function kurir()
    {
        return $this->belongsTo(User::class, 'kurir_id');
    }
}
