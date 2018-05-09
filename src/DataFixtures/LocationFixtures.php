<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LocationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $locations=[
            [500.42,500.30],
            [500.9,500.61],
            [500.31,500.56],
            [500.91,500.85],
            [500.17,500.79],
            [500.77,500.68],
            [500.50,500.82],
            [500.72,500.1],
            [500.35,500.52],
            [500.67,500.100],
            [500.45,500.32],
            [500.29,500.36],
            [500.69,500.75],
            [500.71,500.97],
            [500.96,500.92],
            [500.76,500.74],
            [500.3,500.7],
            [500.10,500.21],
            [500.46,500.4],
            [500.84,500.37],
            [500.14,500.15],
            [500.13,500.90],
            [500.55,500.60],
            [500.88,500.62],
            [500.59,500.83],
            [500.58,500.25],
            [500.93,500.28],
            [500.64,500.16],
            [500.89,500.47],
            [500.87,500.81],
            [500.20,500.38],
            [500.53,500.95],
            [500.57,500.5],
            [500.26,500.6],
            [500.70,500.23],
            [500.40,500.51],
            [500.34,500.49],
            [500.18,500.98],
            [500.33,500.73],
            [500.44,500.2],
            [500.99,500.27],
            [500.43,500.22],
            [500.8,500.80],
            [500.54,500.39],
            [500.86,500.12],
            [500.41,500.48],
            [500.19,500.94],
            [500.63,500.78],
            [500.24,500.11],
            [500.65,500.63],
        ];
        foreach ($locations as $location){
            $enttity= new Location();
            $enttity->setLongitude($location[0]);
            $enttity->setLatitude($location[1]);
            $manager->persist($enttity);
        }
        $manager->flush();
    }
}