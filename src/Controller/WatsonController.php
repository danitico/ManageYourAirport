<?php

namespace App\Controller;


use FindBrok\WatsonBridge\Bridge;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WatsonController extends Controller
{
    /**
     * @Route("/watson", name="watson")
     */
    public function index()
    {

        $bridge = new Bridge(getenv('USERNAME_WATSON'), getenv('PASSWORD'), getenv('URL_WATSON'));
        var_dump($bridge);

        return $this->render('watson/index.html.twig', [
            'controller_name' => 'WatsonController',
        ]);
    }
}
