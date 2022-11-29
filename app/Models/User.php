<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /* protected $fillable = [
        'name',
        'email',
        'password',
    ]; */
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function grouptour()
    {
        return $this->hasOne(GroupTour::class);
    }
    public function reviews()
    {
    return $this->hasMany(Review::class);
    }
    public function places()
    {
    return $this->hasMany(Place::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function bookingGroupTours()
    {
        return $this->hasMany(BookingGroupTour::class);
    }
    public function bookingToPlace()
    {

        return $this->belongsToMany(Place::class,'bookings','user_id','place_id')->withPivot('id','date');
    }
    public function sendPasswordResetNotification($token)
    {

        $url = 'https://127.0.0.1:8000/reset-password?token=' . $token;

        $this->notify(new ResetPasswordNotification($url));
    }
    public function orders()
    {
        return $this->hasManyThrough(Order::class,Place::class);
    }
    public function payments()
    {
        return $this->hasManyThrough(Booking::class,Order::class);
    }
     /*  public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    } */
}
