<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Peron extends Model
{
    protected $table = "people";

    public function user() {
        return $this->belongsTo(User::class, "id", "user_id");
    }
}
