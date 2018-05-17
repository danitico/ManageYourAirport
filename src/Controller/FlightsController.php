<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FlightsController extends Controller
{
    /**
     * @Route("/flights", name="flights")
     */
    public function flights()
    {
        return $this->render('flights/flights.html.twig', [
            'controller_name' => 'FlightsController',
        ]);
    }

    /**
     * @Route("/flights/track/incomming", name="flights tracking incomming")
     */
    public function tracking_outcomming()
    {
        $password=$this->getDoctrine()->getRepository('App:Settings')->getSettings()->getOpenSkyPassword();
        $time=time()-36000;
        $url="https://".getenv('USERNAME_OPENSKY') . ":" . getenv('PASSWORD_OPENSKY')."@opensky-network.org/api/flights/departure?airport=EDDF&begin=1517227200&end=1517230800";


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_USERPWD => getenv('USERNAME_OPENSKY') . ":" . getenv('PASSWORD_OPENSKY'),
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


        dump($url);
        var_dump($datos);

        return $this->render('flights/flights_tracking.html.twig', [
            'controller_name' => 'FlightsController',
        ]);
    }
//https://chema969:Chema957081430@opensky-network.org/api/flights/departure?airport=EDDF&begin=1517227200&end=1517230800
    /**
     * @Route("/flights/track/outcomming", name="flights tracking outcomming")
     */
    public function tracking_incomming()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "",
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

        return $this->render('flights/flights_tracking.html.twig', [
            'controller_name' => 'FlightsController',
        ]);
    }
}
