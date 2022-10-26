<?php

namespace App\Http\Resources;

use App\Http\Helpers\Helper;
use App\Models\Category;
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
       $category = 'hi';
    /*    if(!$category){
        return Helper::sendError('Category Can not found');
        
       }else
 */
        return [
            'name' => $this->name,
            'description' => $this->description,
            'features' => $this->features,
            'rating' => $this->rating,
            'price' => $this->price,
            'category' => $category,
            'user_id' => $this->user_id
        ];
    }
}
