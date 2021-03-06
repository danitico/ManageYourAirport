<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WatsonRepository")
 */
class Watson
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
    private $send;

    /**
     * @ORM\Column(type="array", length=255, nullable=true)
     */
    private $received;

    public function __construct()
    {
        $this->received = array();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSend(): ?string
    {
        return $this->send;
    }

    public function setSend(string $send): self
    {
        $this->send = $send;

        return $this;
    }

    public function getReceived(): ?array
    {
        return $this->received;
    }

    public function setReceived(array $received): self
    {
        $this->received = $received;

        return $this;
    }
}
