<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\TruckState;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TruckStateFixtures extends Fixture
{
    public const SERVICEABLE = 'serviceable';
    public const FAULTY = 'faulty';
    public const STATES = [
        self::SERVICEABLE,
        self::FAULTY,
    ];

    public const TRUCK_STATE_REFERENCE = 'truck-state-ref-';

    public function load(ObjectManager $manager)
    {
        foreach (self::STATES as $index => $state) {
            $truckState = new TruckState();
            $truckState->setName($state);
            $manager->persist($truckState);

            $this->addReference(self::TRUCK_STATE_REFERENCE . $index, $truckState);
        }

        $manager->flush();
    }
}
