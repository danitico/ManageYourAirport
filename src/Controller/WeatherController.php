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
        $url_aemet="https://opendata.aemet.es/opendata/api/prediccion/especifica/municipio/diaria/14021/?api_key=".getenv('AEMET_KEY')."";
        dump($url_aemet);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url_aemet,
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

        date_default_timezone_set("Europe/Madrid");
        $time=time();

        if      ($time < strtotime('06:00:00')){
            $timeindex=3;
            $timeindextemperatura=0;
        }elseif ($time < strtotime('12:00:00')){
            $timeindex=4;
            $timeindextemperatura=1;
        }elseif ($time < strtotime('18:00:00')) {
            $timeindex=5;
            $timeindextemperatura=2;
        }elseif ($time < strtotime('24:00:00')) {
            $timeindex=6;
            $timeindextemperatura=3;
        }else{
            $timeindex=3;
            $timeindextemperatura=0;
        }


        $vientoAhora=$response1[0]['prediccion']['dia'][0]['viento'][$timeindex]['velocidad'];
        $cieloAhora=$response1[0]['prediccion']['dia'][0]['estadoCielo'][$timeindex]['descripcion'];
        $cotaNieveAhora=$response1[0]['prediccion']['dia'][0]['cotaNieveProv'][$timeindex]['value'];
        $precipitacionAhora=$response1[0]['prediccion']['dia'][0]['probPrecipitacion'][$timeindex]['value'];
        $temperaturaAhora=$response1[0]['prediccion']['dia'][0]['temperatura']['dato'][$timeindextemperatura]['value'];
        if ($cotaNieveAhora==""){
            $cotaNieveAhora='no aplicable';
        }
        if ($cieloAhora==""){
        $cieloAhora='Soleado';
        }


        $vientoHoy=$response1[0]['prediccion']['dia'][0]['viento'][0]['velocidad'];
        $cieloHoy=$response1[0]['prediccion']['dia'][0]['estadoCielo'][0]['descripcion'];
        $cotaNieveHoy=$response1[0]['prediccion']['dia'][0]['cotaNieveProv'][0]['value'];
        $precipitacionHoy=$response1[0]['prediccion']['dia'][0]['probPrecipitacion'][0]['value'];
        $temperaturaMaximaHoy=$response1[0]['prediccion']['dia'][0]['temperatura']['maxima'];
        $temperaturaMinimaHoy=$response1[0]['prediccion']['dia'][0]['temperatura']['minima'];
        if ($cotaNieveHoy==""){
            $cotaNieveHoy='no aplicable';
        }
        if ($cieloHoy=="") {
            $cieloHoy = 'Soleado';
        }


        $vientoManana=$response1[0]['prediccion']['dia'][1]['viento'][0]['velocidad'];
        $cieloManana=$response1[0]['prediccion']['dia'][1]['estadoCielo'][0]['descripcion'];
        $cotaNieveManana=$response1[0]['prediccion']['dia'][1]['cotaNieveProv'][0]['value'];
        $precipitacionManana=$response1[0]['prediccion']['dia'][1]['probPrecipitacion'][0]['value'];
        $temperaturaMaximaManana=$response1[0]['prediccion']['dia'][1]['temperatura']['maxima'];
        $temperaturaMinimaManana=$response1[0]['prediccion']['dia'][1]['temperatura']['minima'];
        if ($cotaNieveManana==""){
            $cotaNieveManana='no aplicable';
        }
        if ($cieloManana==""){
            $cieloManana='Soleado';
        }

        $failed = ($precipitacionAhora=="")&&($precipitacionHoy=="")&&($precipitacionManana=="");

        return $this->render('weather/index.html.twig', [
            'controller_name' => 'WeatherController',
            'failed' => $failed,

            'viento_ahora' => $vientoAhora,
            'estado_cielo_ahora' => $cieloAhora,
            'cota_de_nieve_ahora' => $cotaNieveAhora,
            'precipitacion_ahora' => $precipitacionAhora,
            'temperatura_ahora' => $temperaturaAhora,

            'viento_hoy' => $vientoHoy,
            'estado_cielo_hoy' => $cieloHoy,
            'cota_de_nieve_hoy' => $cotaNieveHoy,
            'precipitacion_hoy' => $precipitacionHoy,
            'temperatura_maxima_hoy' => $temperaturaMaximaHoy,
            'temperatura_minima_hoy' => $temperaturaMinimaHoy,

            'viento_manana' => $vientoManana,
            'estado_cielo_manana' => $cieloManana,
            'cota_de_nieve_manana' => $cotaNieveManana,
            'precipitacion_manana' => $precipitacionManana,
            'temperatura_maxima_manana' => $temperaturaMaximaManana,
            'temperatura_minima_manana' => $temperaturaMinimaManana,
        ]);
    }
}
