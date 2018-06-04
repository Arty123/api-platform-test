<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Truck;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TruckFixtures extends Fixture implements DependentFixtureInterface
{
    public const TRUCK_REFERENCE = 'truck-ref-';

    public function getDependencies()
    {
        return [
            TruckStateFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $truck = new Truck();
        $truck->setCapacity(20);
        $truck->setCurrentState($this->getReference(TruckStateFixtures::TRUCK_STATE_REFERENCE . 1));
        $truck->setDriversCount(2);
        $truck->setRegistrationNumber('WB22344');
        $manager->persist($truck);
        $this->addReference(self::TRUCK_REFERENCE, $truck);

        $manager->flush();
    }
}
