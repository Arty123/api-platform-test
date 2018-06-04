<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity
 */
class Truck
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $registrationNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $driversCount;

    /**
     * @ORM\Column(type="integer")
     */
    private $capacity;

    /**
     * @ORM\OneToOne(targetEntity="TruckState")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     */
    private $currentState;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistrationNumber(): ?string
    {
        return $this->registrationNumber;
    }

    public function setRegistrationNumber(string $registrationNumber): self
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    public function getDriversCount(): ?int
    {
        return $this->driversCount;
    }

    public function setDriversCount(int $driversCount): self
    {
        $this->driversCount = $driversCount;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getCurrentState(): ?TruckState
    {
        return $this->currentState;
    }

    public function setCurrentState(?TruckState $currentState): self
    {
        $this->currentState = $currentState;

        return $this;
    }
}
