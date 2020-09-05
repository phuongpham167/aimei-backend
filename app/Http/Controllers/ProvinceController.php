<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProvinceResource;
use App\Support\Facades\thirdPartyAPIFacades;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = thirdPartyAPIFacades::getProvinces();

        return ProvinceResource::collection($provinces);
    }
}
