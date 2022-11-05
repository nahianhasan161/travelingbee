<?php

namespace App\Http\Resources;

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
            'id' => $this->id,
            'name' => $this->name,
            'feature_image' => $this->feature_image,
            'description' => $this->description,
            'features' => $this->features,
            'rating' => $this->rating,
            'price' => $this->price,
            'status' =>$this->status,
            'date' => $this->pivot ? $this->pivot->date : '',
            'booking_id' => $this->pivot ? $this->pivot->id : '',

            /* 'booking' => $this->bookings ? $this->bookings->where('user_id',auth()->user()->id)->all() : '' */
        ];
    }
}
