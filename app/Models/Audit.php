<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audits';
    protected $guarded = [];

    use HasFactory;

    public function tracking(){
        return $this->belongsTo(Tracking::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function logs() {
        return $this->belongsToMany(Log::class, foreignPivotKey: "audit_id");
    }
}
