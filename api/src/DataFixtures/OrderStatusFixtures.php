<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\OrderStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class OrderStatusFixtures extends Fixture
{
    public const ORDER_STATUS_REFERENCE = 'order-status-ref-';
    public const COMPLETED = 'completed';
    public const NOT_COMPLETED = 'not completed';
    public const STATUSES = [
        self::COMPLETED,
        self::NOT_COMPLETED,
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::STATUSES as $index => $status) {
            $orderStatus = new OrderStatus();
            $orderStatus->setName($status);
            $manager->persist($orderStatus);

            $this->addReference(self::ORDER_STATUS_REFERENCE . $index, $orderStatus);
        }

        $manager->flush();
    }
}
