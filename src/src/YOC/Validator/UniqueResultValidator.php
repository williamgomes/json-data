<?php

namespace YOC\Validator;

use Symfony\Component\DependencyInjection\ContainerInterface;
use YOC\Entity\WeatherRecord;

/**
 * Class CountryAndCityValidator
 * @package YOC\Validator
 */
class UniqueResultValidator extends AbstractYocValidator
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
        $iCountryId = $params['country_id'];
        $iCityId = $params['city_id'];
        $sRecordDate = $params['record_date'];

        $oRecordDate = \DateTime::createFromFormat('Y-m-d', $sRecordDate);

        //check if weather record exist
        $oExistWeatherRecord = $this->getObjectManager()->getRepository(WeatherRecord::class)->findOneBy(array(
            'countryId' => $iCountryId,
            'cityId' => $iCityId,
            'recordDate' => $oRecordDate
        ));

        if (empty($oExistWeatherRecord)) {
            return true;
        }

        return false;
    }
}