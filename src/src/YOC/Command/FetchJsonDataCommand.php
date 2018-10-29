<?php

namespace YOC\Command;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use YOC\Entity\Cities;
use YOC\Entity\Countries;
use YOC\Entity\WeatherRecord;
use YOC\Model\AbstractCommand;
use YOC\Provider\DataProvider\ApiDataProvider;
use YOC\Validator\CountryAndCityValidator;

/**
 * Class FetchJsonDataCommand
 * @package YOC\Command
 */
class FetchJsonDataCommand extends AbstractCommand
{

    protected function configure()
    {
        $this
            //setting command details
            ->setName('yoc:fetch:json-data')
            ->setDescription('Fetch JSON data from YOC API.')
            ->setHelp('This command will allow you to fetch weather data from YOC RestAPI and save into database.')
            //setting parameters for the command
            ->addArgument('country_code', InputArgument::OPTIONAL, '2 digit country code (e.g. "DE" for Germany')
            ->addArgument('city_name', InputArgument::OPTIONAL, 'Full name of a city related for given country_code (e.g. "Berlin" the capital of Germany');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(array(
            '<info>YOC Weather Rest API</info>',
            '<info>====================</info>',
            '',
        ));

        if (!empty($input->getArgument('country_code'))) {

            try {
                $sCountryCode = strtolower($input->getArgument('country_code'));
                $sCountryCode = str_replace(' ', '', $sCountryCode);

                $sCityName = strtolower($input->getArgument('city_name'));
                $sCityName = str_replace(' ', '', $sCityName);

                $aParams = array(
                    'country_code' => strtoupper($sCountryCode),
                    'city_name' => ucfirst($sCityName)
                );

                $oValidator = new CountryAndCityValidator($this->getContainer());
                if ($oValidator->validate($aParams)) {

                    $output->writeln(sprintf(
                        '<comment>Your given city "%s" matched with given country "%s"</comment>',
                        $input->getArgument('city_name'),
                        $input->getArgument('country_code')
                    ));

                    $oDataProvider = new ApiDataProvider($sCountryCode, $sCityName);
                    $aWeatherData = $oDataProvider->provideData();

                    $output->writeln(sprintf('<comment>Total %s entry found.</comment>', count($aWeatherData)));
                    $output->writeln('<comment>Processing data.....Saving record</comment>');

                    //get country and city object
                    $oCountry = $this->getObjectManager()->getRepository(Countries::class)->findOneBy(array('countryCode' => $sCountryCode));
                    $oCity = $this->getObjectManager()->getRepository(Cities::class)->findOneBy(array(
                        'countryId' => $oCountry->getId(),
                        'cityName' => $sCityName
                    ));


                    foreach ($aWeatherData as $oWeather) {
                        if (!empty($oWeather)) {

                            $oRecordDate = \DateTime::createFromFormat('Y-m-d', $oWeather['data'][0]['datetime']);

                            //check if weather record exist
                            $oExistWeatherRecord = $this->getObjectManager()->getRepository(WeatherRecord::class)->findOneBy(array(
                                'countryId' => $oCountry->getId(),
                                'cityId' => $oCity->getId(),
                                'recordDate' => $oRecordDate
                            ));

                            if (empty($oExistWeatherRecord)) {
                                $oWeatherRecord = new WeatherRecord();

                                $oWeatherRecord->setTimezone($oWeather['timezone']);
                                $oWeatherRecord->setCountryId($oCountry->getId());
                                $oWeatherRecord->setCityId($oCity->getId());
                                $oWeatherRecord->setRecordDate($oRecordDate);
                                $oWeatherRecord->setMaxTemp($oWeather['data'][0]['max_temp']);
                                $oWeatherRecord->setMinTemp($oWeather['data'][0]['min_temp']);
                                $oWeatherRecord->setAvgTemp($oWeather['data'][0]['temp']);
                                $oWeatherRecord->setCreatedAt(\date('Y-m-d H:i:s'));

                                $this->getObjectManager()->persist($oWeatherRecord);
                                $this->getObjectManager()->flush();
                            } else {
                                $output->writeln(sprintf(
                                    '<error>Duplicate Entry Error: Data for country "%s" city "%s" for the date "%s" already exist in database</error>',
                                    $input->getArgument('country_code'),
                                    $input->getArgument('city_name'),
                                    $oWeather['data'][0]['datetime']
                                ));
                            }
                        }
                    }

                } else {
                    $output->writeln(sprintf(
                        '<error>Your given city "%s" does not match with given country "%s"</error>',
                        $input->getArgument('city_name'),
                        $input->getArgument('country_code')
                    ));
                }
            } catch (\Exception $exception) {
                $output->writeln('<error>' . $exception->getMessage() . '</error>');
            }
        }
    }
}