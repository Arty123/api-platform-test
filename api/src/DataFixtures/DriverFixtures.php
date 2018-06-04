<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Driver;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DriverFixtures extends Fixture implements DependentFixtureInterface
{
    public const DRIVER_REFERENCE = 'driver-ref-';

    public function getDependencies()
    {
        return [
            CityFixtures::class,
            DriverStatusFixtures::class,
            TruckFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $driver = new Driver();
        $driver->setFirstName('John');
        $driver->setLastName('Doe');
        $driver->setHours(6);
        $driver->addTruck($this->getReference(TruckFixtures::TRUCK_REFERENCE));
        $driver->setCurrentCity($this->getReference(CityFixtures::CITY_REFERENCE . 1));
        $driver->setDriverStatus($this->getReference(DriverStatusFixtures::DRIVER_STATUS_REFERENCE . 1));
        $manager->persist($driver);

        $this->addReference(self::DRIVER_REFERENCE, $driver);

        $manager->flush();
    }
}
