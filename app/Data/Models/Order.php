<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = [
        'uuid',
        'order_date',
        'delivery_date',
        'adults',
        'children',
        'user_id',
        'customer',
        'is_closed',
        'note',
    ];
}
