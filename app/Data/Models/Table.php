<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = "tables";

    protected $fillable = [
        'name',
        'chairs',
        'available',
        'description',
    ];

    public $casts = [
        "available" => "boolean",
    ];


    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_batles', 'table_id', 'order_id');
    }

}
