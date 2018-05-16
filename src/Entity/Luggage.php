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
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="luggage", cascade={"persist", "remove"})
     */
    private $Owner;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isLost;

    public function getId()
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->Owner;
    }

    public function setOwner(?User $Owner): self
    {
        $this->Owner = $Owner;

        return $this;
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
}
