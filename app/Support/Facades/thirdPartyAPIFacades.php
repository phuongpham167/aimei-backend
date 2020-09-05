<?php

namespace App\Support\Facades;


use App\Support\thirdPartyAPI;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getProvinces()
 * @see thirdPartyAPI::getProvinces()*
 * @method static Collection getProvincePopulation($provinceId)
 * @see thirdPartyAPI::getProvincePopulation($provinceId)*
 * @method static Collection getProvinceDistricts($provinceId)
 * @see thirdPartyAPI::getProvinceDistricts($provinceId)
 * @method static Collection getPopulationInDistrict($provinceId, $districtId)
 * @see thirdPartyAPI::getPopulationInDistrict($provinceId, $districtId)
 */
class thirdPartyAPIFacades extends Facade
{
    public static function getFacadeAccessor()
    {
        return thirdPartyAPI::class;
    }
}
