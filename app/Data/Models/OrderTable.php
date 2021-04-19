<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTable extends Model
{
    protected $table = 'order_tables';

    public function table(){
        return $this->belongsTo(Table::class, 'table_id', 'id');
    }
}
