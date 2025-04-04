<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function item(){
        return $this->belongsTo(Item::class);
    }
}
