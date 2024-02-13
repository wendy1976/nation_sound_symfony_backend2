<?php

namespace App\Entity;

use App\Repository\ConcertRepository; // Le dépôt associé à l'entité Concert
use Doctrine\Common\Collections\ArrayCollection; // Une collection qui contient les objets en mémoire
use Doctrine\Common\Collections\Collection; // Interface pour les collections
use Doctrine\DBAL\Types\Types; // Les types de base de données pris en charge par Doctrine
use Doctrine\ORM\Mapping as ORM; // Alias pour toutes les annotations Doctrine ORM
use Symfony\Component\HttpFoundation\File\File; // Représente un fichier envoyé par un client
use Symfony\UX\Turbo\Attribute\Broadcast; // Attribut pour activer la diffusion en temps réel
use Symfony\Component\Validator\Constraints as Assert; // Alias pour toutes les contraintes de validation Symfony
use Vich\UploaderBundle\Mapping\Annotation as Vich; // Alias pour toutes les annotations Vich Uploader

#[ORM\Entity(repositoryClass: ConcertRepository::class)] // Définit l'entité et son dépôt associé
#[Broadcast] // Active la diffusion en temps réel pour cette entité
#[Vich\Uploadable] // Permet à cette entité de gérer l'upload de fichiers

class Concert
{
    #[ORM\Id] // Identifie cette propriété comme l'identifiant unique de l'entité
    #[ORM\GeneratedValue] // Indique que la valeur de l'identifiant est générée automatiquement
    #[ORM\Column] // Mappe cette propriété à une colonne de base de données
    private ?int $id = null;

    #[ORM\Column(length: 255)] // Mappe cette propriété à une colonne de base de données avec une longueur maximale de 255 caractères
    private ?string $nom_artiste = null;

    #[ORM\Column(length: 255)] // Mappe cette propriété à une colonne de base de données avec une longueur maximale de 255 caractères
    private ?string $designation = null;

    #[ORM\Column(type: Types::TEXT)] // Mappe cette propriété à une colonne de base de données de type texte
    private ?string $description = null;

    #[ORM\OneToOne(inversedBy: 'concert', cascade: ['persist', 'remove'])] // Définit une relation un-à-un avec l'entité DateConcert
    #[ORM\JoinColumn(nullable: false)] // Cette colonne ne peut pas être nulle
    private ?DateConcert $date_concert = null;

    #[ORM\ManyToOne(inversedBy: 'concerts')] // Définit une relation plusieurs-à-un avec l'entité Scene
    #[ORM\JoinColumn(nullable: false)] // Cette colonne ne peut pas être nulle
    private ?Scene $scene = null;

    #[ORM\ManyToOne(inversedBy: 'concerts')] // Définit une relation plusieurs-à-un avec l'entité Musique
    private ?Musique $musique = null;

    #[Vich\UploadableField(mapping: 'concert_images', fileNameProperty: 'image')] // Définit ce champ comme un champ téléchargeable
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)] // Mappe cette propriété à une colonne de base de données qui peut être nulle
    private ?string $image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)] // Mappe cette propriété à une colonne de base de données de type datetime qui peut être nulle
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'concert', targetEntity: ConcertPass::class)] // Définit une relation un-à-plusieurs avec l'entité ConcertPass
    private Collection $concertPasses;

    public function __construct()
    {
        $this->concertPasses = new ArrayCollection(); // Initialise la collection de passes de concert
    }

    public function __toString()
    {
        // Retournez ici une propriété appropriée de l'objet Concert en chaîne de caractères
        return $this->nom_artiste;
    }

    public function getId(): ?int
    {
        return $this->id; // Retourne l'ID du concert
    }

    public function getNomArtiste(): ?string
    {
        return $this->nom_artiste; // Retourne le nom de l'artiste du concert
    }

    public function setNomArtiste(string $nom_artiste): static
    {
        $this->nom_artiste = $nom_artiste; // Définit le nom de l'artiste du concert

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation; // Retourne la désignation du concert
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation; // Définit la désignation du concert

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description; // Retourne la description du concert
    }

    public function setDescription(string $description): static
    {
        $this->description = $description; // Définit la description du concert

        return $this;
    }

    public function getDateConcert(): ?DateConcert
    {
        return $this->date_concert; // Retourne la date du concert
    }

    public function setDateConcert(DateConcert $date_concert): static
    {
        $this->date_concert = $date_concert; // Définit la date du concert

        return $this;
    }

    public function getScene(): ?Scene
    {
        return $this->scene; // Retourne la scène du concert
    }

    public function setScene(?Scene $scene): static
    {
        $this->scene = $scene; // Définit la scène du concert

        return $this;
    }

    public function getMusique(): ?Musique
    {
        return $this->musique; // Retourne la musique du concert
    }

    public function setMusique(?Musique $musique): static
    {
        $this->musique = $musique; // Définit la musique du concert

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile; // Retourne le fichier image du concert
    }

    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile; // Définit le fichier image du concert

        if ($imageFile) {
            $this->updatedAt = new \DateTimeImmutable(); // Met à jour la date de mise à jour si un fichier image est défini
        }
    }

    public function getImage(): ?string
    {
        return $this->image; // Retourne l'image du concert
    }

    public function setImage(?string $image): void
    {
        $this->image = $image; // Définit l'image du concert
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt; // Retourne la date de mise à jour du concert
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt; // Définit la date de mise à jour du concert
    }

    /**
    * @return Collection<int, ConcertPass>
    */
    public function getConcertPasses(): Collection
    {
        return $this->concertPasses; // Retourne la collection de passes de concert
    }

    public function addConcertPass(ConcertPass $concertPass): self
    {
        if (!$this->concertPasses->contains($concertPass)) {
            $this->concertPasses[] = $concertPass; // Ajoute un pass de concert à la collection
            $concertPass->setConcert($this); // Définit le concert associé au pass
        }

        return $this;
    }

    public function removeConcertPass(ConcertPass $concertPass): self
    {
        if ($this->concertPasses->removeElement($concertPass)) { // Supprime un pass de concert de la collection
            // définit le côté propriétaire sur null (sauf si déjà modifié)
            if ($concertPass->getConcert() === $this) {
                $concertPass->setConcert(null); // Supprime l'association entre le pass de concert et le concert
            }
        }

        return $this;
    }
}