<?php

namespace App\Controller;

use App\Entity\Settings;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $settings = $manager->getRepository('App:Settings')->getSettings();
        $form=$this->createFormBuilder($settings)
            ->add('slackChannel', TextType::class, array('label' => 'Channel'))
            ->add('webhookURL', TextType::class, array('label' => 'Webhook'))
            ->add('flightsWindowsTime', NumberType::class, array('label' => 'Ventana de tiempo para aviones'))
            ->add('save', SubmitType::class, array('label' => 'Enviar'))
            ->getForm();

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
