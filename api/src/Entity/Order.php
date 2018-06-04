<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource
 * @ORM\Entity
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $uniqueId;

    /**
     * @ORM\OneToOne(targetEntity="OrderStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $orderStatus;

    /**
     * @ORM\ManyToMany(targetEntity="WayPoint")
     * @ORM\JoinTable(name="way_points_orders",
     *      joinColumns={@ORM\JoinColumn(name="order_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="way_point_id", referencedColumnName="id")}
     *      )
     */
    private $wayPoints;

    /**
     * @ORM\OneToOne(targetEntity="Truck")
     * @ORM\JoinColumn(name="truck_id", referencedColumnName="id")
     */
    private $truck;

    /**
     * @ORM\OneToMany(targetEntity="Driver", mappedBy="order")
     */
    private $drivers;

    public function __construct()
    {
        $this->wayPoints = new ArrayCollection();
        $this->drivers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUniqueId(): ?string
    {
        return $this->uniqueId;
    }

    public function setUniqueId(string $uniqueId): self
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    public function getOrderStatus(): ?OrderStatus
    {
        return $this->orderStatus;
    }

    public function setOrderStatus(?OrderStatus $orderStatus): self
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    /**
     * @return Collection|WayPoint[]
     */
    public function getWayPoints(): Collection
    {
        return $this->wayPoints;
    }

    public function addWayPoint(WayPoint $waypoint): self
    {
        if (!$this->wayPoints->contains($waypoint)) {
            $this->wayPoints[] = $waypoint;
        }

        return $this;
    }

    public function removeWayPoint(WayPoint $waypoint): self
    {
        if ($this->wayPoints->contains($waypoint)) {
            $this->wayPoints->removeElement($waypoint);
        }

        return $this;
    }

    public function getTruck(): ?Truck
    {
        return $this->truck;
    }

    public function setTruck(?Truck $truck): self
    {
        $this->truck = $truck;

        return $this;
    }

    /**
     * @return Collection|Driver[]
     */
    public function getDrivers(): Collection
    {
        return $this->drivers;
    }

    public function addDriver(Driver $driver): self
    {
        if (!$this->drivers->contains($driver)) {
            $this->drivers[] = $driver;
            $driver->setOrder($this);
        }

        return $this;
    }

    public function removeDriver(Driver $driver): self
    {
        if ($this->drivers->contains($driver)) {
            $this->drivers->removeElement($driver);
            // set the owning side to null (unless already changed)
            if ($driver->getOrder() === $this) {
                $driver->setOrder(null);
            }
        }

        return $this;
    }
}
