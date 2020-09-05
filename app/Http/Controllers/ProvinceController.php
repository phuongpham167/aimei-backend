<?php

namespace App\Http\Controllers;

use App\Http\Resources\DistrictCollection;
use App\Http\Resources\ProvinceResource;
use App\Support\Facades\thirdPartyAPIFacades;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = thirdPartyAPIFacades::getProvinces();

        return ProvinceResource::collection($provinces);
    }

    public function show(Request $request, $provinceId)
    {
        $populations = thirdPartyAPIFacades::getProvincePopulation($provinceId);

        $districts = thirdPartyAPIFacades::getProvinceDistricts($provinceId);

        return [
            'province_id' => $provinceId,
            'populations' => $populations['population'],
            'districts' => (new DistrictCollection($districts))->withProvince($provinceId)
        ];
    }
}
