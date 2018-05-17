<?php

namespace App\Controller;

use App\Entity\Watson;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WatsonController extends Controller
{
    /**
     * @Route("/watson", name="watson")
     */
    public function index(Request $request)
    {

        $manager=$this->getDoctrine()->getManager();
        $Watson=new Watson();
        $form=$this->createFormBuilder($Watson)
            ->add('send', TextType::class, array('label' => 'Mensaje'))
            ->add('Enviar', SubmitType::class, array('label' => 'Enviar sugerencia'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $a = $Watson->getSend();
            $pipo = array("input" => array("text" => $a));
            $pipo = json_encode($pipo);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://gateway.watsonplatform.net/assistant/api/v1/workspaces/" . getenv('WORKSPACE') . "/message?version=2018-02-16",
                CURLOPT_USERPWD => getenv('USERNAME_WATSON') . ":" . getenv('PASSWORD_WATSON'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'),
                CURLOPT_POSTFIELDS => $pipo,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $response = json_decode($response, true);
            $Watson->setReceived($response['output']['text']);

            //persist the changes in the database
            $manager->persist($Watson);
            $manager->flush();

            //returns the same page
            return $this->render('watson/index.html.twig', [
                'controller_name' => 'WatsonController',
                'form' => $form->createView(),
                'mensajes' => $manager->getRepository('App:Watson')->findAll(),
            ]);
        }


        return $this->render('watson/index.html.twig', [
            'controller_name' => 'WatsonController',
            'form' => $form->createView(),
            'mensajes' => $manager->getRepository('App:Watson')->findAll(),
        ]);
    }
}
