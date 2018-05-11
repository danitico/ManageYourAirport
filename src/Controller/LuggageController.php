<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuggageController extends Controller
{
    /**
     * @Route("/luggage", name="luggage")
     */
    public function index()
    {
        return $this->render('luggage/index.html.twig', [
            'controller_name' => 'LuggageController',
        ]);
    }
}
