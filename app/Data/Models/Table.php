<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'name',
        'chairs',
        'available',
        'description',
    ];

    public $casts = [
        "available" => "boolean",
    ];
}
