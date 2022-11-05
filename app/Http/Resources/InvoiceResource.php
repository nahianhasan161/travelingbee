<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'date' => $this->bookingToUser? $this->bookingToUser[0]->pivot->date : '',
            'booking_id' => $this->bookingToUser? $this->bookingToUser[0]->pivot->id : '',
            'User' => $this->bookingToUser ? $this->bookingToUser[0]->only('name','email') : '',
            'owner' => User::find($this->user_id)->only('name','email'), 
           /*  'booking_id' => $this->pivot->id ? $this->pivot->id : '', */
        ];
    }
}
