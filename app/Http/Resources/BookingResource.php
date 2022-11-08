<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->place->id,
            'name' => $this->place->name,
            'feature_image' => $this->place->feature_image,
            'description' => $this->place->description,
            'features' => $this->place->features,
            'rating' => $this->place->rating,
            'price' => $this->place->price,
            'status' =>$this->place->status,
            'owner' =>  User::find($this->place->user_id) ,
            'user' => $this->user,
             'date' =>  $this->date ,
            'booking_id' =>  $this->id,
            'payment' => $this->orders,

            /* 'booking' => $this->bookings ? $this->bookings->where('user_id',auth()->user()->id)->all() : '' */
        ];
    }
}
