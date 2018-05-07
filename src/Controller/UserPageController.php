<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserPageController extends Controller
{
    /**
     * @Route("/userpage", name="user_page")
     */
    public function index()
    {
        return $this->render('user_page/index.html.twig', [
            'controller_name' => 'UserPageController',
        ]);
    }
}
