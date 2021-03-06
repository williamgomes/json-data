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
class CityAndCountryReportController extends Controller
{
    /**
     * @Route("/countries/all", name="show_countries")
     * @param Request $request
     * @return array
     * @Method("GET")
     * @Template("@Report/CityAndCountryReport/showAllCountry.html.twig")
     */
    public function showAllCountryAction(Request $request)
    {
        $oCountries = $this->getDoctrine()->getRepository(Countries::class)->findAll();

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