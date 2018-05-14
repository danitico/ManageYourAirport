<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TrackeoAvionesController extends Controller
{
    /**
     * @Route("/trackeo/aviones", name="trackeo_aviones")
     */
    public function index()
    {
        return $this->render('trackeo_aviones/index.html.twig', [
             'controller_name' => 'TrackeoAvionesController',
        ]);
    }
}
