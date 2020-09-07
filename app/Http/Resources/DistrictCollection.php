<?php

namespace App\Http\Resources;

use App\Support\Facades\ThirdPartyAPIFacades;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DistrictCollection extends ResourceCollection
{
    protected $province = 0;

    public function withProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    public function toArray($request)
    {
        $districts = $this->resource;

        return $districts
            ->map(function ($district) {
                $populationInDistrict = ThirdPartyAPIFacades::getPopulationInDistrict($this->province ,$district['id']);

                return [
                    'distric_id' => $district['id'],
                    'distric_name' => $district['name'],
                    'distric_population' => $populationInDistrict['population']
                ];
            });
    }
}
