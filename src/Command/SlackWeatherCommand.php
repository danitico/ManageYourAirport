<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SlackWeatherCommand extends Command
{
    protected static $defaultName = 'slackWeather';

    protected function configure()
    {
        $this
            ->setDescription('It sends the weather information each hour')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('weather', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('weather')) {

            date_default_timezone_set("Europe/Madrid");
            $time=time();

            if      ($time >= strtotime('00:00:00') && $time <= strtotime('02:59:59')){
                $timeindex=0;
            }elseif ($time >= strtotime('03:00:00') && $time <= strtotime('03:59:59')){
                $timeindex=1;
            }elseif ($time >= strtotime('04:00:00') && $time <= strtotime('04:59:59')) {
                $timeindex=2;
            }elseif ($time >= strtotime('05:00:00') && $time <= strtotime('05:59:59')) {
                $timeindex=3;
            }elseif ($time >= strtotime('06:00:00') && $time <= strtotime('06:59:59')) {
                $timeindex=4;
            }elseif ($time >= strtotime('07:00:00') && $time <= strtotime('07:59:59')) {
                $timeindex=5;
            }elseif ($time >= strtotime('08:00:00') && $time <= strtotime('08:59:59')) {
                $timeindex=6;
            }elseif ($time >= strtotime('09:00:00') && $time <= strtotime('09:59:59')) {
                $timeindex=7;
            }elseif ($time >= strtotime('10:00:00') && $time <= strtotime('10:59:59')) {
                $timeindex=8;
            }elseif ($time >= strtotime('11:00:00') && $time <= strtotime('11:59:59')) {
                $timeindex=9;
            }elseif ($time >= strtotime('12:00:00') && $time <= strtotime('12:59:59')) {
                $timeindex=10;
            }elseif ($time >= strtotime('13:00:00') && $time <= strtotime('13:59:59')) {
                $timeindex=11;
            }elseif ($time >= strtotime('14:00:00') && $time <= strtotime('14:59:59')) {
                $timeindex=12;
            }elseif ($time >= strtotime('15:00:00') && $time <= strtotime('15:59:59')) {
                $timeindex=13;
            }elseif ($time >= strtotime('16:00:00') && $time <= strtotime('16:59:59')) {
                $timeindex=14;
            }elseif ($time >= strtotime('17:00:00') && $time <= strtotime('17:59:59')) {
                $timeindex=15;
            }elseif ($time >= strtotime('18:00:00') && $time <= strtotime('18:59:59')) {
                $timeindex=16;
            }elseif ($time >= strtotime('19:00:00') && $time <= strtotime('19:59:59')) {
                $timeindex=17;
            }elseif ($time >= strtotime('20:00:00') && $time <= strtotime('20:59:59')) {
                $timeindex=18;
            }elseif ($time >= strtotime('21:00:00') && $time <= strtotime('21:59:59')) {
                $timeindex=19;
            }elseif ($time >= strtotime('22:00:00') && $time <= strtotime('22:59:59')) {
                $timeindex=20;
            }elseif ($time >= strtotime('23:00:00') && $time <= strtotime('23:59:59')) {
                $timeindex=21;
            }

            //echo $timeindex;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://opendata.aemet.es/opendata/api/prediccion/especifica/municipio/horaria/14021/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJkYW5pdGljbzk4QGdtYWlsLmNvbSIsImp0aSI6IjJiNWZmYjM0LWYxMmYtNGE2MC04MGNlLTQ0YTJlYzU5ZmQyMCIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNTIwMDkyNjMzLCJ1c2VySWQiOiIyYjVmZmIzNC1mMTJmLTRhNjAtODBjZS00NGEyZWM1OWZkMjAiLCJyb2xlIjoiIn0.TWKUBWfpi1SuIl0qkwaTCtasprFR7BjQ6U_b41dKlVE",
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

            var_dump($response);

            $datos = json_decode($response, true);

            $datos = $datos['datos'];

            echo $datos;


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

            /*$mensaje= "El estado del cielo es " . $response1[0]['prediccion']['dia'][0]['estadoCielo'][$timeindex]['descripcion'];
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


        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
