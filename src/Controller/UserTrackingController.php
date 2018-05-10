<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
        $form = $this->createFormBuilder()
            ->add('latitude', HiddenType::class)
            ->add('longitude', HiddenType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $latitude=$request->request->get('latitude');
            $longitude=$request->request->get('longitude');

            $location->setLatitude((float)$latitude);
            $location->setLongitude((float)$longitude);


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
