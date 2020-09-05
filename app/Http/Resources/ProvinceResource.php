<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
{
    public function toArray($request)
    {
        $province = $this->resource;

        return [
            'id' => $province['id'],
            'name' => $province['name']
        ];
    }
}
