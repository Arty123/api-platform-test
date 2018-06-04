<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\WayPoint;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class WayPointFixtures extends Fixture implements DependentFixtureInterface
{
    public const WAY_POINT_REFERENCE = 'way-point-ref-';

    public function getDependencies()
    {
        return [
            CityFixtures::class,
            WayPointTypeFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        foreach (CityFixtures::CITIES as $index => $data) {
            $wayPoint = new WayPoint();
            $wayPoint->setCity($this->getReference(CityFixtures::CITY_REFERENCE . $index));
            $wayPoint->setWayPointType($this->getReference(WayPointTypeFixtures::WAY_POINT_TYPE_REFERENCE . $index));
            $manager->persist($wayPoint);

            $this->addReference(self::WAY_POINT_REFERENCE . $index, $wayPoint);
        }

        $manager->flush();
    }
}
