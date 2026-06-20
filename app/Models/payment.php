<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'amount',
        'status',
        'method',
        'notes',
        'paid_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generatePaymentId()
    {
        return 'PAY-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }
}