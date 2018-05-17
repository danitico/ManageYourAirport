<?php

namespace App\DataFixtures;

use App\Entity\Luggage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LuggageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $luggages = [
            [ 2,false,],
            [ 3,true,],
            [ 4,false,],
            [ 5,false,],
        ];

        foreach ($luggages as $luggage){
            $ent=new Luggage();
            $ent->setAirlineId($luggage[0]);
            $ent->setIsLost($luggage[1]);
            $manager->persist($ent);
        }
        $manager->flush();
    }
}
