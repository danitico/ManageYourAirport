<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuggageController extends Controller
{
    /**
     * @Route("/luggage/lost", name="lost luggage")
     */
    public function lost_luggage()
    {
        $luggages=$this->getDoctrine()->getRepository('App:Luggage')->getLostLuggage();
        return $this->render('luggage/all_luggage.html.twig', [
            'controller_name' => 'LuggageController',
            'luggages' => $luggages,
        ]);
    }


    /**
     * @Route("/luggage", name="luggage")
     */
    public function all_luggage()
    {
        $luggages=$this->getDoctrine()->getRepository('App:Luggage')->getAllLuggage();
        return $this->render('luggage/all_luggage.html.twig', [
            'controller_name' => 'LuggageController',
            'luggages' => $luggages,
        ]);
    }
}
