<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TrafficController extends Controller
{
    /**
     * @Route("/traffic", name="traffic")
     */
    public function index()
    {
        return $this->render('traffic/index.html.twig', [
            'controller_name' => 'TrafficController',
        ]);
    }
}
