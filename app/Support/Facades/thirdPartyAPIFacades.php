<?php

namespace App\Support\Facades;


use App\Support\thirdPartyAPI;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getProvinces()
 * @see thirdPartyAPI::getProvinces()
 */
class thirdPartyAPIFacades extends Facade
{
    public static function getFacadeAccessor()
    {
        return thirdPartyAPI::class;
    }
}
