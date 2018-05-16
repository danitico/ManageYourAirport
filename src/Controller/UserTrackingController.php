<?php

namespace App\Controller;

use App\Entity\Location;
use App\Entity\LocationsCollection;
use App\Entity\User;
use App\Form\LocationType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserTrackingController extends Controller
{
    /**
     * @Route("/map", name="user_tracking")
     */
    public function singleUserLocation(Request $request)
    {
        $location=new Location();
        $form = $this->createFormBuilder()
            ->add('latitude', HiddenType::class)
            ->add('longitude', HiddenType::class)
            ->getForm();

        $manager = $this->getDoctrine()->getManager();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $latitude=$request->request->get('latitude');
            $longitude=$request->request->get('longitude');

            $location->setLatitude((float)$latitude);
            $location->setLongitude((float)$longitude);

            $user=$this->getUser();
            $user->setLocation($location);
            $locationsCollection = $this->getDoctrine()->getRepository('App:LocationsCollection')->getCollection(1);
            $locationsCollection[0]->addLocation($location);

            $manager->persist($user);
            $manager->persist($locationsCollection[0]);
            $manager->flush();
            sleep(1);
            return $this->redirectToRoute('user_tracking');
        }
        $location = array();
        $location[] = $this->getUser()->getLocation();

        return $this->render('user_tracking/single_user_location.html.twig',[
            'form' => $form->createView(),
            'locations' => $location,
        ]);
    }

    /**
     * @Route("/map/heatmap", name="heatmap")
     */
    public function heatmap(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $locations = $manager->getRepository('App:Location')->getAllLocations();

        return $this->render('user_tracking/heatmap.html.twig', [
            'controller_name' => 'LocationsController',
            'locations' => $locations,
        ]);
    }
}
