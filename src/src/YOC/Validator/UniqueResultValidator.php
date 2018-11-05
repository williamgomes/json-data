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
        $iCountry = $params['country'];
        $iCity = $params['city'];
        $oRecordDate = $params['record_date'];

        //check if weather record exist
        $oExistWeatherRecord = $this->getObjectManager()->getRepository(WeatherRecord::class)->findOneBy(array(
            'country' => $iCountry,
            'city' => $iCity,
            'recordDate' => $oRecordDate
        ));

        if (empty($oExistWeatherRecord)) {
            return true;
        }

        return false;
    }
}