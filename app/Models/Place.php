<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(PlaceImage::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function bookingToUser()
    {
    return $this->belongsToMany(User::class,'bookings','place_id','user_id')->withPivot('date','id');
    }
    public function reviews()
    {
    return $this->belongsToMany(Review::class);
    }
}
