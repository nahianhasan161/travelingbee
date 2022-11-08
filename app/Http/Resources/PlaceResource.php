<?php

namespace App\Http\Resources;

use App\Http\Helpers\Helper;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       
    /*    if(!$category){
        return Helper::sendError('Category Can not found');
        
       }else
 */
        return [
           'id' => $this->id,
         'name' => $this->name,
        'feature_image' => $this->feature_image,
        'description' => $this->description,
        'features' => $this->features,
        'rating' => $this->rating,
        'price' => $this->price,
    'category' => $this->category ? $this->category->only('id','name') : [],
       'user' => User::find( $this->user_id) ? User::find( $this->user_id)->only('id','name','email','image') : '', 
        'images' =>   $this->whenLoaded('images') ,
        'bookings' => $this->bookings 
        /* 'user_name' =>  $this->owner, */
    ];
    }
}
