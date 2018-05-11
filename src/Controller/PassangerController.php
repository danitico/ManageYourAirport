<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PassangerController extends Controller
{
    /**
     * @Route("/passanger", name="passanger")
     */
    public function index()
    {
        return $this->render('passanger/index.html.twig', [
            'controller_name' => 'PassangerController',
        ]);
    }
}
