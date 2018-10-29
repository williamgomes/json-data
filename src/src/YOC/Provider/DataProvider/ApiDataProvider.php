<?php

namespace YOC\Provider\DataProvider;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class ApiDataProvider implements DataProviderInterface
{
    const JSON_REPORT_DATA_URL = 'https://yoc-media.github.io/weather/report';

    private $sCountryCode;
    private $sCityName;

    /**
     * JsonDataProvider constructor.
     * @param string $sCountryCode
     * @param string $sCityName
     */
    public function __construct($sCountryCode = '', $sCityName = '')
    {
        $this->sCountryCode = strtoupper($sCountryCode);
        $this->sCityName = ucfirst(strtolower($sCityName));
    }

    /**
     * @return array
     */
    public function provideData()
    {
        try {
            $httpClient = new Client();
            $response = $httpClient->request('GET', $this->getApiUrl());
            $sJsonResult = $response->getBody();
            $aResult = json_decode($sJsonResult, true);

            return $aResult;
        } catch (ClientException $ex) {
            throw new \Exception('ApiDataProvider Error: ' . $ex->getMessage());
        }
    }

    /**
     * @return string
     */
    protected function getApiUrl()
    {
        return self::JSON_REPORT_DATA_URL . '/' . $this->sCountryCode . '/' . $this->sCityName . '.json';
    }
}