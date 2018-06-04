<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setEmail('qwe@qwe.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPlainTextPassword('password');

        $manager->persist($user);
        $manager->flush();
    }
}
