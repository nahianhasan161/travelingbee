<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /* return parent::toArray($request); */

        return [
            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->image,
            'token' => $this->createToken('Token')->plainTextToken,
            'roles' => $this->roles->pluck('name') ?? [] ,
            'permissions' => $this->permissions->pluck('name') ?? [],
            'email_verified' => $this->email_verified_at ? true : false,
            'created_at' => $this->created_at->format('d-m-Y')
        ];
    }
}
