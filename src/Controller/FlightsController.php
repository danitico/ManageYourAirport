<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FlightsController extends Controller
{
    /**
     * @Route("/flights/track/outcomming", name="flights_tracking_outcomming")
     */
    public function tracking_outcomming()
    {
        $time_start=time()-$this->getDoctrine()->getRepository('App:Settings')->getSettings()->getFlightsWindowsTime();
        $time_end=time();
        $url="https://".getenv('USERNAME_OPENSKY') . ":" . getenv('PASSWORD_OPENSKY')."@opensky-network.org/api/flights/departure?airport=LEMD&begin=".$time_start."&end=".$time_end."";


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
        dump($datos);

        $flights=[];

        foreach ($datos as $flight){
            $flights[]=[$flight['icao24'],$flight['estDepartureAirportHorizDistance'],$flight['estDepartureAirport'],$flight['estArrivalAirport']];
        }

        return $this->render('flights/flightsDepartures.html.twig', [
            'controller_name' => 'FlightsController',
            'flights' => $flights,
        ]);
    }

    /**
     * @Route("/flights/track/incomming", name="flights_tracking_incomming")
     */
    public function tracking_incomming()
    {
        $time_start=time()-$this->getDoctrine()->getRepository('App:Settings')->getSettings()->getFlightsWindowsTime();
        $time_end=time();
        $url="https://".getenv('USERNAME_OPENSKY') . ":" . getenv('PASSWORD_OPENSKY')."@opensky-network.org/api/flights/arrival?airport=LEMD&begin=".$time_start."&end=".$time_end."";


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
        dump($datos);

        $flights=[];

        foreach ($datos as $flight){
            $flights[]=[$flight['icao24'],$flight['estArrivalAirportHorizDistance'],$flight['estDepartureAirport'],$flight['estArrivalAirport']];
        }

        return $this->render('flights/flightsArrival.html.twig', [
            'controller_name' => 'FlightsController',
            'flights' => $flights,
        ]);
    }
}
