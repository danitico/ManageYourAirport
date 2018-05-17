<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class NumberFlightsCommand extends Command
{
    protected static $defaultName = 'NumberFlights';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('display', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('display')) {
            $curl = curl_init();
            $time=time()-3600;
            $time2=time();
            $url="https://chema969:Chema957081430@opensky-network.org/api/flights/departure?airport=LEMD&begin=" . $time . "&end=" . $time2;
        var_dump($url);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_USERPWD => "chema969:Chema957081430",
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

            $ehe=(count($datos));
            $message="Han salido en la ultima hora " . $ehe . " vuelos.";
            $url="https://hooks.slack.com/services/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";

            $payload = json_encode(
                array(
                    "channel" => "#general",
                    "username" => "newUsersBot",
                    "text" => $message,
                )
            );
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
