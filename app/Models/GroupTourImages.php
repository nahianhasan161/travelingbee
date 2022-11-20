<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTourImages extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function grouptour()
    {
        return $this->belongsTo(GroupTour::class);
    }
}
