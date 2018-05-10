<?php

namespace App\Controller;

use App\Form\LocationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LocationsController extends Controller
{
    /**
     * @Route("/locations", name="locations")
     */
    public function index(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locations = $manager->getRepository('App:Location')->getAllLocations();
        $location = $locations[0];


        return $this->render('locations/index.html.twig', [
            'controller_name' => 'LocationsController',
            'locations' => $locations,
        ]);
    }
}
