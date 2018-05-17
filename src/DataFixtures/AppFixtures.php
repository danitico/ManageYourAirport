<?php

namespace App\DataFixtures;

use App\Entity\Location;
use App\Entity\LocationsCollection;
use App\Entity\Luggage;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadUsers(ObjectManager $manager)
    {
        $locationsCollection = new LocationsCollection();


        $users = [
            [ 'admin',    ['ROLE_ADMIN',], 'admin@gmail.com'             ,[37.844537, -4.843806],[ 1,false,],],
            [ 'diego',    ['ROLE_USER' ,], 'good.old.seg.fault@gmail.com',null                  ,null],
            [ 'danitico', ['ROLE_USER' ,], 'danitico@gmail.com'          ,null                  ,null],
        ];
        foreach ($users as $user) {
            $entity = new User();
            $entity->setUsername($user[0]);
            $entity->setRoles($user[1]);
            $entity->setEmail($user[2]);
            $password = $this->encoder->encodePassword($entity, 'secret');
            $entity->setPassword($password);

            if ($user[3] != null) {
                $location = new Location();

                $location->setLatitude ($user[3][0]);
                $location->setLongitude($user[3][1]);

                $locationsCollection->addLocation($location);
                $entity->setLocation($location);
            }
            if ($user[4] != null) {
                $luggage = new Luggage();

                $luggage->setAirlineId($user[4][0]);
                $luggage->setIsLost   ($user[4][1]);

                $entity->addLuggage($luggage);
            }

            $manager->persist($luggage);
            $manager->persist($location);
            $manager->persist($entity);

            $this->addReference($user[0], $entity);
        }
        $manager->persist($locationsCollection);

        $manager->flush();
    }
}
