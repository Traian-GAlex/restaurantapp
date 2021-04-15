<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $casts = [
        "prevent_deletion" => "boolean",
    ];
    public function users() {
        return $this->belongsToMany(User::class, "user_roles", "role_id", "user_id");
    }
}
