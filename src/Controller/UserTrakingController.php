<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserTrakingController extends Controller
{
    /**
     * @Route("/track", name="user_traking")
     */
    public function index()
    {
        return $this->render('user_traking/index.html.twig', [
            'controller_name' => 'UserTrakingController',
        ]);
    }
}
