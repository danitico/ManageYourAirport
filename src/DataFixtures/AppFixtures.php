<?php

namespace App\DataFixtures;

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

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
    }

    private function loadUsers(ObjectManager $manager)
    {
        $users = [
            [ 'admin', ['ROLE_ADMIN',], 'test1@gmail.com',],
            [ 'diego', ['ROLE_USER' ,], 'good.old.seg.fault@gmail.com',],
        ];

        foreach ($users as $user) {
            $entity = new User();
            $entity->setUsername($user[0]);
            $entity->setRoles($user[1]);
            $entity->setEmail($user[2]);
            $password = $this->encoder->encodePassword($entity, 'secret');
            $entity->setPassword($password);

            $manager->persist($entity);
            $this->addReference($user[0], $entity);
        }

        $manager->flush();
    }
}
