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

        /*var_dump($response1);*/

        //echo $response1['0'];

        /*echo "Probabilidad de precipitacion";
        echo nl2br("\n");
        foreach ($response1[0]['prediccion']['dia'][0]['probPrecipitacion'] as $values){
            echo $values['periodo'] . " -> " . $values['value'];
            echo nl2br("\n");
        }

        echo nl2br("\n");
        echo "Cota de nieve";
        echo nl2br("\n");
        foreach ($response1[0]['prediccion']['dia'][0]['cotaNieveProv'] as $values){
            echo $values['periodo'] . " -> ";
            if($values['value'] === ""){
                echo "Ninguna";
            }
            echo nl2br("\n");
        }

        echo nl2br("\n");
        echo "Estado del cielo";
        echo nl2br("\n");
        foreach ($response1[0]['prediccion']['dia'][0]['estadoCielo'] as $values){
            echo $values['periodo'] . " -> ";
            if($values['descripcion'] === ""){
                echo "Despejado";
            }
            else{
                echo $values['descripcion'];
            }
            echo nl2br("\n");
        }

        echo nl2br("\n");
        echo "Viento";
        echo nl2br("\n");
        foreach ($response1[0]['prediccion']['dia'][0]['viento'] as $values){
            echo $values['periodo'] . " -> ";
            if($values['velocidad'] !== 0){
                echo $values['velocidad'] . " km/h dirección " . $values['direccion'];
            }
            else{
                echo $values['velocidad'];
            }
            echo nl2br("\n");
        }*/

        //echo "Probabilidad Precipitacion 00-06 -> " . $response1[0]['prediccion']['dia'][0]['probPrecipitacion'][1]['value'];

        //var_dump($response1);




        return $this->render('weather/index.html.twig', [
            'controller_name' => 'WeatherController',
            'viento' => $response1[0]['prediccion']['dia'][0]['viento'],
            'estado_cielo' => $response1[0]['prediccion']['dia'][0]['estadoCielo'],
            'cota de nieve' => $response1[0]['prediccion']['dia'][0]['cotaNieveProv'],
            'precipitacion' => $response1[0]['prediccion']['dia'][0]['probPrecipitacion'],
        ]);
    }
}
