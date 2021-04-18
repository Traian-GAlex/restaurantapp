<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable =[
        'name',
        'price',
        'image',
        'description',
    ];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_details', 'item_id', 'order_id');
    }
}
