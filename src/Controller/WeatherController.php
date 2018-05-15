<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WeatherController extends Controller
{
    /**
     * @Route("/weather", name="weather", methods="GET")
     */
    public function index(/*Request $request*/)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://opendata.aemet.es/opendata/api/prediccion/especifica/municipio/diaria/14021/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJkYW5pdGljbzk4QGdtYWlsLmNvbSIsImp0aSI6IjJiNWZmYjM0LWYxMmYtNGE2MC04MGNlLTQ0YTJlYzU5ZmQyMCIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNTIwMDkyNjMzLCJ1c2VySWQiOiIyYjVmZmIzNC1mMTJmLTRhNjAtODBjZS00NGEyZWM1OWZkMjAiLCJyb2xlIjoiIn0.TWKUBWfpi1SuIl0qkwaTCtasprFR7BjQ6U_b41dKlVE",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $datos = json_decode($response, true);

        $datos = $datos['datos'];

        /*echo $datos;*/

        /*var_dump($datos);*/

        $curl1 = curl_init();
        curl_setopt_array($curl1, array(
            CURLOPT_URL => $datos,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response1 = curl_exec($curl1);

        curl_close($curl1);

        $response1 = utf8_encode($response1);

        $response1 = json_decode($response1, true);

        /*$mensaje= "El usuario " . $user->getUsername() . " se ha registrado correctamente.";
        $url="https://hooks.slack.com/services/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";

        $payload = json_encode(
            array(
                "channel" => "#general",
                "username" => "newUsersBot",
                "text" => $mensaje,
            )
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);*/

        return $this->render('weather/index.html.twig', [
            'controller_name' => 'WeatherController',
            'viento' => $response1[0]['prediccion']['dia'][0]['viento'],
            'estado_cielo' => $response1[0]['prediccion']['dia'][0]['estadoCielo'],
            'cota de nieve' => $response1[0]['prediccion']['dia'][0]['cotaNieveProv'],
            'precipitacion' => $response1[0]['prediccion']['dia'][0]['probPrecipitacion'],
        ]);
    }
}
