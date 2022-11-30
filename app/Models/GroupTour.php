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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(GroupTourImages::class);
    }
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
    public function bookingsGroupTour()
    {
        return $this->hasMany(BookingGroupTour::class);
    }
}
