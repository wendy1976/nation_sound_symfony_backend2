<?php

namespace App\Entity;

use App\Repository\DateConcertRepository; // Le dépôt associé à l'entité DateConcert
use Doctrine\DBAL\Types\Types; // Les types de base de données pris en charge par Doctrine
use Doctrine\ORM\Mapping as ORM; // Alias pour toutes les annotations Doctrine ORM
use Symfony\UX\Turbo\Attribute\Broadcast; // Attribut pour activer la diffusion en temps réel

#[ORM\Entity(repositoryClass: DateConcertRepository::class)] // Définit l'entité et son dépôt associé
#[Broadcast] // Active la diffusion en temps réel pour cette entité

class DateConcert
{
    #[ORM\Id] // Identifie cette propriété comme l'identifiant unique de l'entité
    #[ORM\GeneratedValue] // Indique que la valeur de l'identifiant est générée automatiquement
    #[ORM\Column] // Mappe cette propriété à une colonne de base de données
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)] // Mappe cette propriété à une colonne de base de données de type datetime
    private ?\DateTimeInterface $date_heure = null;

    #[ORM\OneToOne(mappedBy: 'date_concert', cascade: ['persist', 'remove'])] // Définit une relation un-à-un avec l'entité Concert
    private ?Concert $concert = null;

    public function getId(): ?int
    {
        return $this->id; // Retourne l'ID de la date du concert
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->date_heure; // Retourne la date et l'heure du concert
    }

    public function setDateHeure(\DateTimeInterface $date_heure): static
    {
        $this->date_heure = $date_heure; // Définit la date et l'heure du concert

        return $this;
    }

    public function getConcert(): ?Concert
    {
        return $this->concert; // Retourne le concert associé à la date
    }

    public function setConcert(Concert $concert): static
    {
        // set the owning side of the relation if necessary
        if ($concert->getDateConcert() !== $this) {
            $concert->setDateConcert($this); // Définit la date du concert associé
        }

        $this->concert = $concert; // Définit le concert associé à la date

        return $this;
    }

    private function dateToFrench(\DateTimeInterface $date, $format) {
        $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
        $date_string = $date->format('Y-m-d H:i:s');
        return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date_string)))); // Convertit une date en format français
    }

    public function __toString(): string
    {
        return $this->dateToFrench($this->date_heure, 'd F Y \à H:i'); // Retourne la date et l'heure du concert en format français
    }

    public function getDay(): string
    {
        return $this->dateToFrench($this->date_heure, 'd F Y'); // Retourne le jour du concert en format français
    }
}
