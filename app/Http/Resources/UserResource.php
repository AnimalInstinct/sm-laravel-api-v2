<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Role;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
          'phone' => $this->phone,
          'email' => $this->email,
          'active' => $this->active,
          'images'=>$this->images,
          'display_image_id'=>$this->display_image_id,
          'email_verified_at' => $this->email_verified_at,
          'created_at' => (string) $this->created_at,
          'updated_at' => (string) $this->updated_at,
          'deleted_at' => (string) $this->deleted_at,
      ];
    }
}
