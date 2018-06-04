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
 */
class Driver
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @ORM\Column(type="integer")
     */
    private $hours;

    /**
     * @ORM\OneToOne(targetEntity="DriverStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $driverStatus;

    /**
     * @ORM\OneToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $currentCity;

    /**
     * @ORM\ManyToMany(targetEntity="Truck")
     * @ORM\JoinTable(name="drivers_trucks",
     *      joinColumns={@ORM\JoinColumn(name="driver_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="truck_id", referencedColumnName="id")}
     *      )
     */
    private $trucks;

    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="drivers")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order;

    public function __construct()
    {
        $this->trucks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getHours(): ?int
    {
        return $this->hours;
    }

    public function setHours(int $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    public function getDriverStatus(): ?DriverStatus
    {
        return $this->driverStatus;
    }

    public function setDriverStatus(?DriverStatus $driverStatus): self
    {
        $this->driverStatus = $driverStatus;

        return $this;
    }

    public function getCurrentCity(): ?City
    {
        return $this->currentCity;
    }

    public function setCurrentCity(?City $currentCity): self
    {
        $this->currentCity = $currentCity;

        return $this;
    }

    /**
     * @return Collection|Truck[]
     */
    public function getTrucks(): Collection
    {
        return $this->trucks;
    }

    public function addTruck(Truck $truck): self
    {
        if (!$this->trucks->contains($truck)) {
            $this->trucks[] = $truck;
        }

        return $this;
    }

    public function removeTruck(Truck $truck): self
    {
        if ($this->trucks->contains($truck)) {
            $this->trucks->removeElement($truck);
        }

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }
}
