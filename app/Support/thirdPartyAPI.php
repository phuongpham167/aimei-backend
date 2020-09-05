<?php

namespace App\Support;

use App\Http\Resources\ProvinceResource;
use GuzzleHttp\Client;

class thirdPartyAPI
{
    private $baseUri;

    public function __construct()
    {
        $this->baseUri = 'https://mockserver-quantv.herokuapp.com';
    }

    protected function guzzle()
    {
        return new Client([
            'base_uri' => $this->baseUri,
            'verify' => false,
        ]);
    }

    protected function getRequest($uri, $data = [])
    {
        $response = $this->guzzle()->get($uri, $data);

        return json_decode($response->getBody()->getContents(), $asArray = true);
    }

    protected function postRequest($uri, $data = [])
    {
        $response = $this->guzzle()->get($uri, ['json' => $data]);

        return json_decode($response->getBody()->getContents(), $asArray = true);
    }

    public function getProvinces()
    {
        return $this->getRequest('/get_provinces', []);
    }

    public function getProvincePopulation($provinceId)
    {
        return $this->getRequest('/province_population', [
            'query' => [
                'province_id' => $provinceId
            ]
        ]);
    }

    public function getProvinceDistricts($provinceId)
    {
        return $this->getRequest('/get_districts', [
            'query' => [
                'province_id' => $provinceId
            ]
        ]);
    }

    public function getPopulationInDistrict($provinceId, $districtId)
    {
        return $this->getRequest('/district_population', [
            'query' => [
                'province_id' => $provinceId,
                'district_id' => $districtId
            ]
        ]);
    }
}
