<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PrivacypolicyController extends Controller
{
    /**
     * @Route("/privacy", name="privacypolicy")
     */
    public function index()
    {
        return $this->render('privacypolicy/index.html.twig', [
            'controller_name' => 'PrivacypolicyController',
        ]);
    }
}
