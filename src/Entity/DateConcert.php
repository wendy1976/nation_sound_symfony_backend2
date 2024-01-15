<?php

namespace App\Entity;

use App\Repository\DateConcertRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: DateConcertRepository::class)]
#[Broadcast]
class DateConcert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_heure = null;

    #[ORM\OneToOne(mappedBy: 'date_concert', cascade: ['persist', 'remove'])]
    private ?Concert $concert = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->date_heure;
    }

    public function setDateHeure(\DateTimeInterface $date_heure): static
    {
        $this->date_heure = $date_heure;

        return $this;
    }

    public function getConcert(): ?Concert
    {
        return $this->concert;
    }

    public function setConcert(Concert $concert): static
    {
        // set the owning side of the relation if necessary
        if ($concert->getDateConcert() !== $this) {
            $concert->setDateConcert($this);
        }

        $this->concert = $concert;

        return $this;
    }

    private function dateToFrench(\DateTimeInterface $date, $format) {
        $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
        $date_string = $date->format('Y-m-d H:i:s');
        return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date_string))));
    }

    public function __toString(): string
    {
        return $this->dateToFrench($this->date_heure, 'd F Y \à H:i');
    }

    public function getDay(): string
    {
        return $this->dateToFrench($this->date_heure, 'd F Y');
    }
}
