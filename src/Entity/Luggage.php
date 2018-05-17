<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LuggageRepository")
 */
class Luggage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $isLost;

    /**
     * @ORM\Column(type="integer")
     */
    private $airlineId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="luggage")
     */
    private $owner;

    public function __toString()
    {
        return (string) $this->getAirlineId();
    }

    public function getId()
    {
        return $this->id;
    }


    public function getIsLost(): ?bool
    {
        return $this->isLost;
    }

    public function setIsLost(bool $isLost): self
    {
        $this->isLost = $isLost;

        return $this;
    }

    public function getAirlineId(): ?int
    {
        return $this->airlineId;
    }

    public function setAirlineId(int $airlineId): self
    {
        $this->airlineId = $airlineId;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
