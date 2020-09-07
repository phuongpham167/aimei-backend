<?php

namespace App\Support\Facades;


use App\Support\ThirdPartyAPI;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getProvinces()
 * @see ThirdPartyAPI::getProvinces()*
 * @method static Collection getProvincePopulation($provinceId)
 * @see ThirdPartyAPI::getProvincePopulation($provinceId)*
 * @method static Collection getProvinceDistricts($provinceId)
 * @see ThirdPartyAPI::getProvinceDistricts($provinceId)
 * @method static Collection getPopulationInDistrict($provinceId, $districtId)
 * @see ThirdPartyAPI::getPopulationInDistrict($provinceId, $districtId)
 */
class ThirdPartyAPIFacades extends Facade
{
    public static function getFacadeAccessor()
    {
        return ThirdPartyAPI::class;
    }
}
