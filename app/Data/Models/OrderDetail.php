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

    protected $appends=[
        'item_image',
        'item_name',
        'item_total',
    ];

    public function getItemTotalAttribute(){
        return number_format((float) ($this->qty * $this->price), 2);
    }

    public function getItemImageAttribute(){
        return $this->order_item->image;
    }

    public function getItemNameAttribute()
    {
        return $this->order_item->name;
    }

    public function order_item(){
        return $this->belongsTo(Menu::class, 'item_id', 'id');
    }
}
