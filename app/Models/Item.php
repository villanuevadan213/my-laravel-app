<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model {
    use HasFactory;
    
    protected $table = 'inventory_items';

    protected $guarded = [];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, foreignPivotKey: "inventory_item_id");
    }
}