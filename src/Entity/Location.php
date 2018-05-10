<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $longitude;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="location", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LocationsCollection", inversedBy="locations")
     */
    private $locationsCollection;
    

    public function __construct()
    {
        $this->setLatitude(0.0);
        $this->setLongitude(0.0);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newLocation = $user === null ? null : $this;
        if ($newLocation !== $user->getLocation()) {
            $user->setLocation($newLocation);
        }

        return $this;
    }

    public function getLocationsCollection(): ?LocationsCollection
    {
        return $this->locationsCollection;
    }

    public function setLocationsCollection(?LocationsCollection $locationsCollection): self
    {
        $this->locationsCollection = $locationsCollection;

        return $this;
    }

    public function __toString(): ?string
    {
        $string="";
        $string.=$this->getLatitude();
        $string.=",";
        $string.=$this->getLongitude();
        return $string;
    }
}
