<?php

namespace App\Entity;

use App\Repository\MusiqueRepository; // Le dépôt associé à l'entité Musique
use Doctrine\Common\Collections\ArrayCollection; // Une collection qui contient les objets en mémoire
use Doctrine\Common\Collections\Collection; // Interface pour les collections
use Doctrine\ORM\Mapping as ORM; // Alias pour toutes les annotations Doctrine ORM
use Symfony\UX\Turbo\Attribute\Broadcast; // Attribut pour activer la diffusion en temps réel

#[ORM\Entity(repositoryClass: MusiqueRepository::class)] // Définit l'entité et son dépôt associé
#[Broadcast] // Active la diffusion en temps réel pour cette entité

class Musique
{
    #[ORM\Id] // Identifie cette propriété comme l'identifiant unique de l'entité
    #[ORM\GeneratedValue] // Indique que la valeur de l'identifiant est générée automatiquement
    #[ORM\Column] // Mappe cette propriété à une colonne de base de données
    private ?int $id = null;

    #[ORM\Column(length: 255)] // Mappe cette propriété à une colonne de base de données avec une longueur maximale de 255 caractères
    private ?string $style_musique = null;

    #[ORM\OneToMany(mappedBy: 'musique', targetEntity: Concert::class)] // Définit une relation un-à-plusieurs avec l'entité Concert
    private Collection $concerts;

    public function __construct()
    {
        $this->concerts = new ArrayCollection(); // Initialise la collection de concerts
    }

    public function getId(): ?int
    {
        return $this->id; // Retourne l'ID de la musique
    }

    public function getStyleMusique(): ?string
    {
        return $this->style_musique; // Retourne le style de la musique
    }

    public function setStyleMusique(string $style_musique): static
    {
        $this->style_musique = $style_musique; // Définit le style de la musique

        return $this;
    }

    /**
     * @return Collection<int, Concert>
     */
    public function getConcerts(): Collection
    {
        return $this->concerts; // Retourne la collection de concerts
    }

    public function addConcert(Concert $concert): static
    {
        if (!$this->concerts->contains($concert)) {
            $this->concerts->add($concert); // Ajoute un concert à la collection
            $concert->setMusique($this); // Définit la musique du concert
        }

        return $this;
    }

    public function removeConcert(Concert $concert): static
    {
        if ($this->concerts->removeElement($concert)) { // Supprime un concert de la collection
            // set the owning side to null (unless already changed)
            if ($concert->getMusique() === $this) {
                $concert->setMusique(null); // Supprime l'association entre le concert et la musique
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->style_musique; // Retourne le style de la musique sous forme de chaîne de caractères
    }
}
