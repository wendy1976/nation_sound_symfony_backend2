<?php

namespace App\Entity;

use App\Repository\ConcertPassRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ConcertPassRepository::class)]
#[Broadcast]
class ConcertPass
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'concertPasses')]
    private ?Concert $concert = null;

    #[ORM\ManyToOne(inversedBy: 'concertPasses')]
    private ?Pass $pass = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConcert(): ?Concert
    {
        return $this->concert;
    }

    public function setConcert(?Concert $concert): static
    {
        $this->concert = $concert;

        return $this;
    }

    public function getPass(): ?Pass
    {
        return $this->pass;
    }

    public function setPass(?Pass $pass): static
    {
        $this->pass = $pass;

        return $this;
    }
}
