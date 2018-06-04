<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CityFixtures extends Fixture
{
    public const LONDON = 'London';
    public const LONDON_DISTANCE = 80;

    public const BIRMINGHAM = 'Birmingham';
    public const BIRMINGHAM_DISTANCE = 30;

    public const CITIES = [
        [self::LONDON, self::LONDON_DISTANCE],
        [self::BIRMINGHAM, self::BIRMINGHAM_DISTANCE],
    ];

    public const CITY_REFERENCE = 'city-ref-';

    public function load(ObjectManager $manager)
    {
        foreach (self::CITIES as $index => $data) {
            $city = new City();
            $city->setName($data[0]);
            $city->setDistance($data[1]);
            $manager->persist($city);

            $this->addReference(self::CITY_REFERENCE . $index, $city);
        }

        $manager->flush();
    }
}
