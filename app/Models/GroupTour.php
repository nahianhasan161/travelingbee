<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTour extends Model
{
    use HasFactory;
    protected $guarded = [];
   /*  protected $casts =  [
        'plans' => 'json',
    ];
    public function setPlansAttribute($value)
    {
        $this->attributes['plans'] = json_decode($value);
    } */

    public function images()
    {
        return $this->hasMany(GroupTourImages::class);
    }
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
