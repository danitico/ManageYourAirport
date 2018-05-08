<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserTrackingController extends Controller
{
    /**
     * @Route("/track", name="user_tracking")
     */
    public function index(Request $request)
    {
        $location=new Location();
        $form = $this->createForm(LocationType::class, $location);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($location);
            $manager->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('user_tracking/index.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
