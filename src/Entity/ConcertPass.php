<?php

namespace App\Entity;

use App\Repository\ConcertPassRepository; // Le dépôt associé à l'entité ConcertPass
use Doctrine\ORM\Mapping as ORM; // Alias pour toutes les annotations Doctrine ORM
use Symfony\UX\Turbo\Attribute\Broadcast; // Attribut pour activer la diffusion en temps réel

#[ORM\Entity(repositoryClass: ConcertPassRepository::class)] // Définit l'entité et son dépôt associé
#[Broadcast] // Active la diffusion en temps réel pour cette entité

class ConcertPass
{
    #[ORM\Id] // Identifie cette propriété comme l'identifiant unique de l'entité
    #[ORM\GeneratedValue] // Indique que la valeur de l'identifiant est générée automatiquement
    #[ORM\Column] // Mappe cette propriété à une colonne de base de données
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'concertPasses')] // Définit une relation plusieurs-à-un avec l'entité Concert
    private ?Concert $concert = null;

    #[ORM\ManyToOne(inversedBy: 'concertPasses')] // Définit une relation plusieurs-à-un avec l'entité Pass
    private ?Pass $pass = null;

    public function getId(): ?int
    {
        return $this->id; // Retourne l'ID du pass de concert
    }

    public function getConcert(): ?Concert
    {
        return $this->concert; // Retourne le concert associé au pass
    }

    public function setConcert(?Concert $concert): static
    {
        $this->concert = $concert; // Définit le concert associé au pass

        return $this;
    }

    public function getPass(): ?Pass
    {
        return $this->pass; // Retourne le pass
    }

    public function setPass(?Pass $pass): static
    {
        $this->pass = $pass; // Définit le pass

        return $this;
    }
}
