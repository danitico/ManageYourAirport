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

        /*$pipo = json_encode("{\"input\": { \"text\": \"Hola\" }}");*/

        /*$pipo = "{\"input\":{\"text\":\"Hola\"}}";*/

        $pipo = json_encode('{input: {text: Hello}}');

        /*var_dump($pipo);*/
        /*.getenv('WORKSPACE').*/

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);


        $response = $client->post('https://gateway.watsonplatform.net/assistant/api/v1/workspaces/dbf19c07-072f-4d5a-b45b-88cdc3d82bfe/message?version=2018-02-16',
            [ 'body' => json_encode(
                "{\"input\": { \"text\": \"Hola\" }}"
            ),
            'auth' => [getenv('USERNAME_WATSON'), getenv('PASSWORD')]

            ]);

        var_dump($response);



        /*$res = $client->post("https://gateway.watsonplatform.net/assistant/api/v1/workspaces/dbf19c07-072f-4d5a-b45b-88cdc3d82bfe/message?version=2018-02-16", [
            'body' => $pipo,
            'auth' => [getenv('USERNAME_WATSON'), getenv('PASSWORD')],
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);*/

            /*$res = $client->request('PUT', "https://gateway.watsonplatform.net/assistant/api/v1/workspaces/dbf19c07-072f-4d5a-b45b-88cdc3d82bfe/message?version=2018-02-16",[
                'auth'=> [getenv('USERNAME_WATSON'), getenv('PASSWORD')],
                'body' => $pipo,
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);*/

        /*var_dump($res);*/

        /*$curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://gateway.watsonplatform.net/assistant/api/v1/workspaces/" . getenv('WORKSPACE') . "/message?version=2018-02-16",
            CURLOPT_USERPWD => getenv('USERNAME_WATSON') . ":" . getenv('PASSWORD'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => "Content-Type: text/plain",
            CURLOPT_POSTFIELDS => $pipo,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);*/

        /*$response = utf8_encode($response);

        $response = json_decode($response, true);*/

/*        var_dump($response);*/
        /*echo $response;*/


        return $this->render('watson/index.html.twig', [
            'controller_name' => 'WatsonController',
        ]);
    }
}
