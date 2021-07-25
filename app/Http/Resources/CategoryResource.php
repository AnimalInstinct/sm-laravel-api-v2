<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'parent_id' => $this->category_id,
            'published' => $this->published,
            'title' => $this->title,
            'description' => $this->description,
            'alias' => $this->alias,
            'seotitle' => $this->seotitle,
            'seokeywords' => $this->seokeywords,
            'seodescription' => $this->seodescription,
            'author' => $this->author,
            'language_id' => $this->language_id,
            'intro_image_id' => $this->intro_image_id,
            'intro_text' => $this->intro_text,
            'site_id' => $this->site_id,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'deleted_at' => (string) $this->deleted_at,
        ];
    }
}
