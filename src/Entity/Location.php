<?php

namespace App\Entity;

use App\Repository\LocationRepository; // Le dépôt associé à l'entité Location
use Doctrine\DBAL\Types\Types; // Les types de base de données pris en charge par Doctrine
use Doctrine\ORM\Mapping as ORM; // Alias pour toutes les annotations Doctrine ORM
use Symfony\Component\HttpFoundation\File\File; // Représente un fichier envoyé par un client
use Symfony\UX\Turbo\Attribute\Broadcast; // Attribut pour activer la diffusion en temps réel
use Symfony\Component\Validator\Constraints as Assert; // Alias pour toutes les contraintes de validation Symfony
use Vich\UploaderBundle\Mapping\Annotation as Vich; // Alias pour toutes les annotations Vich Uploader

#[ORM\Entity(repositoryClass: LocationRepository::class)] // Définit l'entité et son dépôt associé
#[Broadcast] // Active la diffusion en temps réel pour cette entité
#[Vich\Uploadable] // Permet à cette entité de gérer l'upload de fichiers

class Location
{
    #[ORM\Id] // Identifie cette propriété comme l'identifiant unique de l'entité
    #[ORM\GeneratedValue] // Indique que la valeur de l'identifiant est générée automatiquement
    #[ORM\Column] // Mappe cette propriété à une colonne de base de données
    private ?int $id = null;

    #[ORM\Column(length: 255)] // Mappe cette propriété à une colonne de base de données avec une longueur maximale de 255 caractères
    private ?string $category = null;

    #[ORM\Column(type: Types::ARRAY)] // Mappe cette propriété à une colonne de base de données de type tableau
    private array $coordinates = [];

    #[Vich\UploadableField(mapping: 'location_files', fileNameProperty: 'icon')] // Définit ce champ comme un champ téléchargeable
    private ?File $iconFile = null;

    #[ORM\Column(nullable: true)] // Mappe cette propriété à une colonne de base de données qui peut être nulle
    private ?string $icon = null;

    #[ORM\Column(length: 255)] // Mappe cette propriété à une colonne de base de données avec une longueur maximale de 255 caractères
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)] // Mappe cette propriété à une colonne de base de données de type texte
    private ?string $popupContent = null;

    #[Vich\UploadableField(mapping: 'location_files', fileNameProperty: 'image')] // Définit ce champ comme un champ téléchargeable
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)] // Mappe cette propriété à une colonne de base de données qui peut être nulle
    private ?string $image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)] // Mappe cette propriété à une colonne de base de données de type datetime qui peut être nulle
    private ?\DateTimeInterface $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id; // Retourne l'ID de l'emplacement
    }

    public function getCategory(): ?string
    {
        return $this->category; // Retourne la catégorie de l'emplacement
    }

    public function setCategory(string $category): static
    {
        $this->category = $category; // Définit la catégorie de l'emplacement

        return $this;
    }

    public function getCoordinates(): array
    {
        return $this->coordinates; // Retourne les coordonnées de l'emplacement
    }

    public function setCoordinates(array $coordinates): static
    {
        $this->coordinates = $coordinates; // Définit les coordonnées de l'emplacement

        return $this;
    }

    public function getIconFile(): ?File
    {
        return $this->iconFile; // Retourne le fichier icône de l'emplacement
    }

    public function setIconFile(?File $iconFile): void
    {
        $this->iconFile = $iconFile; // Définit le fichier icône de l'emplacement

        if ($iconFile) {
            $this->updatedAt = new \DateTimeImmutable(); // Met à jour la date de mise à jour si un fichier icône est défini
        }
    }

    public function getIcon(): ?string
    {
        return $this->icon; // Retourne l'icône de l'emplacement
    }

    public function setIcon(?string $icon): void
    {
        $this->icon = $icon; // Définit l'icône de l'emplacement
    }

    public function getName(): ?string
    {
        return $this->name; // Retourne le nom de l'emplacement
    }

    public function setName(string $name): static
    {
        $this->name = $name; // Définit le nom de l'emplacement

        return $this;
    }

    public function getPopupContent(): ?string
    {
        return $this->popupContent; // Retourne le contenu de la popup de l'emplacement
    }

    public function setPopupContent(string $popupContent): static
    {
        $this->popupContent = $popupContent; // Définit le contenu de la popup de l'emplacement

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile; // Retourne le fichier image de l'emplacement
    }

    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile; // Définit le fichier image de l'emplacement

        if ($imageFile) {
            $this->updatedAt = new \DateTimeImmutable(); // Met à jour la date de mise à jour si un fichier image est défini
        }
    }

    public function getImage(): ?string
    {
        return $this->image; // Retourne l'image de l'emplacement
    }

    public function setImage(?string $image): void
    {
        $this->image = $image; // Définit l'image de l'emplacement
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt; // Retourne la date de mise à jour de l'emplacement
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt; // Définit la date de mise à jour de l'emplacement
    }
}
