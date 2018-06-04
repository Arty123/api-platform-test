<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\DriverStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DriverStatusFixtures extends Fixture
{
    public const DRIVER_STATUS_REFERENCE = 'driver-status-ref-';
    public const RECREATION = 'recreation';
    public const IN_SHIFT = 'in shift';
    public const BEHIND_THE_WHEEL = 'behind the wheel';

    public const STATUSES = [
        self::RECREATION,
        self::IN_SHIFT,
        self::BEHIND_THE_WHEEL,
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::STATUSES as $index => $status) {
            $driverStatus = new DriverStatus();
            $driverStatus->setName($status);
            $this->addReference(self::DRIVER_STATUS_REFERENCE . $index, $driverStatus);

            $manager->persist($driverStatus);
        }

        $manager->flush();
    }
}
