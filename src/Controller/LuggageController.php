<?php

namespace App\Controller;

use App\Entity\Luggage;
use App\Form\LuggageType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuggageController extends Controller
{
    /**
     * @Route("/luggage/lost", name="lost luggage")
     */
    public function lostLuggage()
    {
        $luggages=$this->getDoctrine()->getRepository('App:Luggage')->getLostLuggage();
        return $this->render('luggage/luggage_printer.html.twig', [
            'controller_name' => 'LuggageController',
            'luggages' => $luggages,
            'header' => "Maletas perdidas",
        ]);
    }


    /**
     * @Route("/luggage", name="luggage")
     */
    public function getAllLuggage(Request $request)
    {
        $luggages=$this->getDoctrine()->getRepository('App:Luggage')->getAllLuggage();
        return $this->render('luggage/luggage_printer.html.twig', [
            'controller_name' => 'LuggageController',
            'luggages' => $luggages,
            'header' => "Todas las maletas",
        ]);
    }


    /**
     * @Route("/luggage/search", name="luggage search")
     */
    public function searchLuggage(Request $request)
    {
        $ent=new Luggage();
        $form=$this->createForm(LuggageType::class, $ent);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $luggages=$this->getDoctrine()->getRepository('App:Luggage')->findById($ent->getAirlineId());
            return $this->render('luggage/search_luggage.html.twig', [
                'controller_name' => 'LuggageController',
                'luggages' => $luggages,
                'form' => $form->createView(),
                'header' => "Resultados de la busqueda",
            ]);
        }

        $luggages=$this->getUser()->getLuggage();


        return $this->render('luggage/search_luggage.html.twig', [
            'controller_name' => 'LuggageController',
            'luggages' => $luggages,
            'form' => $form->createView(),
            'header' => "Tus Maletas",
        ]);
    }
}
