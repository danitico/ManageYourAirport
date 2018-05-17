<?php

namespace App\DataFixtures;

use App\Entity\Location;
use App\Entity\LocationsCollection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LocationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $locationsCollection=$manager->getRepository('App:LocationsCollection')->getCollection();
        //ubicationes de rabanales
        $locations=[
            [37.844208, -4.843712],
            [37.844643, -4.843699],
            [37.844638, -4.843690],
            [37.844640, -4.843685],
            [37.844642, -4.843679],
            [37.844358, -4.843843],
            [37.844357, -4.843852],
            [37.844357, -4.843852],
            [37.844349, -4.843834],
            [37.844349, -4.843844],
            [37.844348, -4.843842],
            [37.844324, -4.843810],
            [37.844322, -4.843805],
            [37.844326, -4.843811],
            [37.844333, -4.843806],
            [37.844433, -4.843724],
            [37.844707, -4.843613],
        ];
        foreach ($locations as $location){
            $enttity= new Location();
            $enttity->setLatitude($location[0]);
            $enttity->setLongitude($location[1]);
            $locationsCollection->addLocation($enttity);
            $manager->persist($enttity);
        }
        $manager->persist($locationsCollection);
        $manager->flush();
    }
}
