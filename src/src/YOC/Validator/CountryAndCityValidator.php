<?php

namespace YOC\Validator;

use Symfony\Component\DependencyInjection\ContainerInterface;
use YOC\Entity\Cities;
use YOC\Entity\Countries;

/**
 * Class CountryAndCityValidator
 * @package YOC\Validator
 */
class CountryAndCityValidator extends AbstractYocValidator
{
    /**
     * CountryAndCityValidator constructor.
     * @param ContainerInterface|null $container
     */
    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param array $params
     * @return bool
     */
    public function validate($params = array())
    {
        $sCountryCode = '';
        $sCityName = '';
        if (isset($params['country_code']) && isset($params['city_name'])) {
            $sCountryCode = $params['country_code'];
            $sCityName = $params['city_name'];
        }
        $iCountryId = $this->getCountryId($sCountryCode);

        if (!$iCountryId) {

        }

        return $this->checkCityForCountryIdAndName($iCountryId, $sCityName);
    }

    /**
     * @param string $sCountryCode
     * @return bool|int
     */
    public function getCountryId($sCountryCode = '')
    {
        $oCountry = $this->getObjectManager()
            ->getRepository(Countries::class)
            ->findOneBy(array(
                'countryCode' => $sCountryCode
            ));

        if ($oCountry instanceof Countries) {
            return $oCountry->getId();
        }

        return false;
    }

    /**
     * @param int $iCountryId
     * @param string $sCityName
     * @return bool
     */
    public function checkCityForCountryIdAndName($iCountryId = 0, $sCityName = '')
    {
        $oCity = $this->getObjectManager()
            ->getRepository(Cities::class)
            ->findOneBy(array(
                'cityName' => $sCityName,
                'countryId' => $iCountryId
            ));

        if ($oCity instanceof Cities) {
            return true;
        }

        return false;
    }
}