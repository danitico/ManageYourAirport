<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Tests\Fixtures\ToString;

class WeatherController extends Controller
{
    /**
     * @Route("/weather", name="check_weather", methods="GET")
     */
    public function index()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://opendata.aemet.es/opendata/api/valores/climatologicos/inventarioestaciones/todasestaciones/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJkYW5pdGljbzk4QGdtYWlsLmNvbSIsImp0aSI6IjJiNWZmYjM0LWYxMmYtNGE2MC04MGNlLTQ0YTJlYzU5ZmQyMCIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNTIwMDkyNjMzLCJ1c2VySWQiOiIyYjVmZmIzNC1mMTJmLTRhNjAtODBjZS00NGEyZWM1OWZkMjAiLCJyb2xlIjoiIn0.TWKUBWfpi1SuIl0qkwaTCtasprFR7BjQ6U_b41dKlVE",
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

        /*$pipo = utf8_encode(file_get_contents("https://opendata.aemet.es/opendata/sh/77d0287b"));

        var_dump(json_decode($pipo, true));*/

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


        foreach ($response1 as $estacion){
            if($estacion['provincia'] == "CORDOBA"){
                echo $estacion['nombre'];
                echo nl2br("\n");
            }


        }

        return $this->render('weather/index.html.twig', [
            'controller_name' => 'WeatherController',
        ]);
    }
}
