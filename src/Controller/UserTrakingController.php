<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserTrakingController extends Controller
{
    /**
     * @Route("/track", name="user_traking")
     */
    public function index(Request $request)
    {
        $location=new Location();
        $form=$this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entitiManager=$this->getDoctrine()->getManager();
            $entitiManager->persist($location);
            $entitiManager->flush();
        }

        return $this->render('user_traking/index.html.twig', [
            'controller_name' => 'UserTrakingController',
        ]);
    }
}
