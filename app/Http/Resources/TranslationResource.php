<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TranslationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'alias' => $this->alias,
            'translation' => $this->translation,
            'language_id' => $this->language_id,
            'component_id' => $this->component_id,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'deleted_at' => (string) $this->deleted_at,
        ];
    }
}
