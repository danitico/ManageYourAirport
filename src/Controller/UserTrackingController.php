<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserTrackingController extends Controller
{
    /**
     * @Route("/track", name="user_tracking")
     */
    public function index()
    {
        return $this->render('user_tracking/index.html.twig', [
            'controller_name' => 'UserTrackingController',
        ]);
    }
}
