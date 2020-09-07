<?php

namespace App\Http\Controllers;

use App\Http\Resources\DistrictCollection;
use App\Http\Resources\ProvinceResource;
use App\Support\Facades\ThirdPartyAPIFacades;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = ThirdPartyAPIFacades::getProvinces();

        return ProvinceResource::collection($provinces);
    }

    public function show(Request $request, $provinceId)
    {
        $populations = ThirdPartyAPIFacades::getProvincePopulation($provinceId);

        $districts = ThirdPartyAPIFacades::getProvinceDistricts($provinceId);

        return [
            'province_id' => $provinceId,
            'populations' => $populations['population'],
            'districts' => (new DistrictCollection($districts))->withProvince($provinceId)
        ];
    }
}
