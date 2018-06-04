<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            DriverFixtures::class,
            WayPointFixtures::class,
            OrderStatusFixtures::class,
            TruckFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $order = new Order();
        $order->addDriver($this->getReference(DriverFixtures::DRIVER_REFERENCE));
        $order->addWayPoint($this->getReference(WayPointFixtures::WAY_POINT_REFERENCE . 1));
        $order->setOrderStatus($this->getReference(OrderStatusFixtures::ORDER_STATUS_REFERENCE . 1));
        $order->setTruck($this->getReference(TruckFixtures::TRUCK_REFERENCE));
        $order->setUniqueId(md5(time()));
//        dump($order); die;
        $manager->persist($order);
        $manager->flush();
    }
}
