<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LocationsController extends Controller
{
    /**
     * @Route("/locations", name="locations")
     */
    public function index()
    {
        return $this->render('locations/index.html.twig', [
            'controller_name' => 'LocationsController',
        ]);
    }
}
