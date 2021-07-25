<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'category_id' => $this->category_id,
            'published' => $this->published,
            'caption' => $this->caption,
            'alt' => $this->alt,
            'description' => $this->description,
            'name' => $this->name,
            'geo' => $this->geo,
            'path' => $this->path,
            'thumbnail_sm' => $this->thumbnail_sm,
            'thumbnail_md' => $this->thumbnail_md,
            'thumbnail_lg' => $this->thumbnail_lg,
            'imageable_type' => $this->imageable_type,
            'imageable_id' => $this->imageable_id,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'deleted_at' => (string) $this->deleted_at,
        ];
    }
}
