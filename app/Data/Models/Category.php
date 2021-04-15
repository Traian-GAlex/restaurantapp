<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function menus(){
        return $this->hasMany(Menu::class);
    }
}
