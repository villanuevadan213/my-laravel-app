<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public function audits() {
        return $this->belongsToMany(Audit::class, relatedPivotKey: "audit_id");
    }
}
