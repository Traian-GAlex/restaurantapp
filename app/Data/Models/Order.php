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

    public function tables(){
        return $this->belongsToMany(Table::class, 'order_tables', 'order_id', 'table_id');
    }

    public function items(){
        return $this->belongsToMany(Menu::class, 'order_details', 'order_id', 'item_id');
    }

    public function payments(){
        return $this->hasMany(OrgerPayment::class, 'order_id', 'id');
    }
}
