<?php

namespace App\Controller;


use GuzzleHttp\Client;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WatsonController extends Controller
{
    /**
     * @Route("/watson", name="watson")
     */
    public function index()
    {
        /*$pipo = '{"input": {"text": "Hello"}}';*/
        $pipo = array("input" => array("text" => "Hello"));
        $pipo = json_encode($pipo);

        /*var_dump($res);*/

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://gateway.watsonplatform.net/assistant/api/v1/workspaces/" . getenv('WORKSPACE') . "/message?version=2018-02-16",
            CURLOPT_USERPWD => getenv('USERNAME_WATSON') . ":" . getenv('PASSWORD'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                /*'Content-Length: ' . strlen($pipo)*/),
            CURLOPT_POSTFIELDS => $pipo,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        /*$response = utf8_encode($response);*/

        var_dump($response);
        /*echo $response;*/


        return $this->render('watson/index.html.twig', [
            'controller_name' => 'WatsonController',
        ]);
    }
}
