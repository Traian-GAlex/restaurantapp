<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    protected $table = "order_payments";

    protected $fillable = [
        'order_id',
        'payment_date',
        'amount',
        'received',
        'change',
        'pos',
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
