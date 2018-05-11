<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FlightsController extends Controller
{
    /**
     * @Route("/flights", name="flights")
     */
    public function index()
    {
        return $this->render('flights/index.html.twig', [
            'controller_name' => 'FlightsController',
        ]);
    }
}
