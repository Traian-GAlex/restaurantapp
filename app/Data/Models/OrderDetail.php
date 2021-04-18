<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_details";

    protected $fillable =[
        'order_id',
        'item_id',
        'qty',
        'price',
    ];


}
