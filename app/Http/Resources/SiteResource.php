<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteResource extends JsonResource
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
            'domain' => $this->domain,
            'alias' => $this->alias,
            'title' => $this->title,
            'description' => $this->description,
            'images' => $this->images,
            'display_image_id'=>$this->display_image_id,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'deleted_at' => (string) $this->deleted_at,
        ];
    }
}
