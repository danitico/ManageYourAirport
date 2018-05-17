<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SlackMainPageController extends Controller
{
    /**
     * @Route("/slack_main_page", name="slack_main_page")
     */
    public function index()
    {
        return $this->redirect('https://manageyourairport.slack.com/');
    }
}
