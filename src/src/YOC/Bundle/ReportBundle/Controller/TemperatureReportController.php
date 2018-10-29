<?php

namespace YOC\Bundle\ReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use YOC\Entity\Cities;
use YOC\Entity\Countries;

/**
 * Class CityAndCountryReportController
 * @package YOC\Bundle\ReportBundle\Controller
 */
class TemperatureReportController extends Controller
{
    /**
     * @Route("/avgtemp/show/{start}/{end}", name="show_avg_temp")
     * @param Request $request
     * @return array
     * @Method("GET")
     * @Template("@Report/TemperatureReport/showAvgTemp.html.twig")
     */
    public function showAvgTempAction($start = '', $end = '')
    {
        $oStartDate = '';
        $oEndDate = '';

        if (!empty($start) || !empty($end)) {
            $oStartDate = \DateTime::createFromFormat('Y-m-d', $start);
            $oEndDate = \DateTime::createFromFormat('Y-m-d', $end);
        }
//        echo $start;
        $oCountries = $this->getDoctrine()->getRepository('Model:WeatherRecord')->getLatestSevenRecords();

        return array(
            'oCountries' => $oCountries
        );
    }


    /**
     * @Route("/cities/all", name="show_cities")
     * @param Request $request
     * @return array
     * @Method("GET")
     * @Template("@Report/CityAndCountryReport/showAllCity.html.twig")
     */
    public function showAllCityAction(Request $request)
    {
        $oCities = $this->getDoctrine()->getRepository('Model:Cities')->getAllCitiesGroupedBy();

        return array(
            'oCities' => $oCities
        );
    }
}