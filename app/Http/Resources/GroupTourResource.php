<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupTourResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'place' => $this->place,
            'division' => $this->division,
            'district' => $this->district,
            'area' => $this->area ,
            'date' => $this->date,
            'day' => $this->day,
            'price' => $this->price,
            'rating' => $this->rating,
            'status' => $this->status,
            'person' => $this->person,
            'feature_image' => $this->feature_image,
            'user' => $this->user,
            'images' => $this->images,
            'plans' => $this->plans,
        ];
    }
}
