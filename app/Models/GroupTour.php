<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTour extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function images()
    {
        return $this->hasMany(GroupTourImages::class);
    }
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
