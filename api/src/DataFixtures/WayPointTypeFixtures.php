<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\WayPointType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class WayPointTypeFixtures extends Fixture
{
    public const EMBARKATION = 'embarkation';
    public const DISCHARGING = 'discharging';
    public const TYPES = [
        self::EMBARKATION,
        self::DISCHARGING,
    ];
    public const WAY_POINT_TYPE_REFERENCE = 'way-point-type-ref-';

    public function load(ObjectManager $manager)
    {
        foreach (self::TYPES as $index => $type) {
            $wayPointType = new WayPointType();
            $wayPointType->setName($type);
            $manager->persist($wayPointType);

            $this->addReference(self::WAY_POINT_TYPE_REFERENCE . $index, $wayPointType);
        }

        $manager->flush();
    }
}
