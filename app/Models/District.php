<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $guarded = [];
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function areas()
    {
        return $this->hasMany(Area::class);
    }
    use HasFactory;
}
