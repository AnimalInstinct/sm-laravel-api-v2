<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DistrictResource;

class CityResource extends JsonResource
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
            'object' => [
              'id' => $this->id,
              'name' => $this->name,
              'created_at' => (string) $this->created_at,
              'updated_at' => (string) $this->updated_at,
              'deleted_at' => (string) $this->deleted_at, 
            ],
            'districts' => DistrictResource::collection($this->districts)
        ];
    }
}
