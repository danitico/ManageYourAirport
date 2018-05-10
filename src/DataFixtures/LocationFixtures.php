<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LocationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //ubicationes de rabanales
        $locations=[
            [37.914630, -4.722435],
            [37.914562, -4.722388],
            [37.914698, -4.722300],
            [37.914650, -4.721994],
            [37.913512, -4.722050],
            [37.913600, -4.721074],
            [37.913591, -4.721094],
            [37.913608, -4.721078],
            [37.914139, -4.722116],
            [37.915231, -4.724151],
            [37.914971, -4.725375],
            [37.915019, -4.725495],
            [37.915706, -4.721596],
            [37.915708, -4.721577],
            [37.915712, -4.721726],
            [37.914206, -4.724028],
            [37.914332, -4.724730],
            [37.914154, -4.722127],
            [37.912819, -4.721001],
            [37.914179, -4.720956],
            [37.914354, -4.720956],
            [37.914584, -4.719950],
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
