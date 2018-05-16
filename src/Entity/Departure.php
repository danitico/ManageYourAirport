<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartureRepository")
 */
class Departure
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icao24;

    /**
     * @ORM\Column(type="integer")
     */
    private $firstSeen;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DepartureAirport;

    /**
     * @ORM\Column(type="integer")
     */
    private $lastSeen;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ArrivalAirport;

    public function getId()
    {
        return $this->id;
    }

    public function getIcao24(): ?string
    {
        return $this->icao24;
    }

    public function setIcao24(string $icao24): self
    {
        $this->icao24 = $icao24;

        return $this;
    }

    public function getFirstSeen(): ?int
    {
        return $this->firstSeen;
    }

    public function setFirstSeen(int $firstSeen): self
    {
        $this->firstSeen = $firstSeen;

        return $this;
    }

    public function getDepartureAirport(): ?string
    {
        return $this->DepartureAirport;
    }

    public function setDepartureAirport(string $DepartureAirport): self
    {
        $this->DepartureAirport = $DepartureAirport;

        return $this;
    }

    public function getLastSeen(): ?int
    {
        return $this->lastSeen;
    }

    public function setLastSeen(int $lastSeen): self
    {
        $this->lastSeen = $lastSeen;

        return $this;
    }

    public function getArrivalAirport(): ?string
    {
        return $this->ArrivalAirport;
    }

    public function setArrivalAirport(string $ArrivalAirport): self
    {
        $this->ArrivalAirport = $ArrivalAirport;

        return $this;
    }
}
