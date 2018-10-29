<?php

namespace YOC\Bundle\NoWorkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 * @package YOC\Bundle\NoWorkBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return array
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $array = array(
            "Hello" => "World!"
        );

        $response = new JsonResponse($array);

        return array(
            'jsonResult' => $response
        );
    }
}
