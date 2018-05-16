<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FlightsController extends Controller
{
    /**
     * @Route("/flights", name="flights")
     */
    public function index()
    {
        return $this->render('flights/flights.html.twig', [
            'controller_name' => 'FlightsController',
        ]);
    }

    /**
     * @Route("/flights/track", name="flights tracking")
     */
    public function tracking()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://opensky-network.org/api/states/all?lamin=36.57858&lomin=-4.826488&lamax=36.905019&lomax=-4.331581",
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
