<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity
 */
class WayPoint
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="WayPointType")
     * @ORM\JoinColumn(name="way_point_id", referencedColumnName="id")
     */
    private $wayPointType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getWayPointType(): ?WayPointType
    {
        return $this->wayPointType;
    }

    public function setWayPointType(?WayPointType $wayPointType): self
    {
        $this->wayPointType = $wayPointType;

        return $this;
    }
}
