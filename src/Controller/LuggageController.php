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
        return $this->render('luggage/lost_luggage.html.twig', [
            'controller_name' => 'LuggageController',
        ]);
    }


    /**
     * @Route("/luggage", name="luggage")
     */
    public function all_luggage()
    {
        return $this->render('luggage/all_luggage.html.twig', [
            'controller_name' => 'LuggageController',
        ]);
    }
}
