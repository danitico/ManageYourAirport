<?php

namespace App\Controller;

use App\Form\SettingsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SettingsController extends Controller
{
    /**
     * @Route("/settings", name="settings")
     */
    public function index(Request $request)
    {
        $manager=$this->getDoctrine()->getManager();
        $settings=$manager->getRepository('App:Settings')->getSettings();
        $form=$this->createForm(SettingsType::class, $settings);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            //persist the changes in the database
            $manager->persist($settings);
            $manager->flush();

            //add confirmation message
            $this->addFlash('positive', 'configuración editada correctamente');

            //returns the same page
            return $this->render('settings/index.html.twig', [
                'controller_name' => 'SettingsController',
                'form' => $form->createView(),
            ]);
        }


        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
            'form' => $form->createView(),
        ]);
    }
}
