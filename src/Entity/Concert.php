<?php

namespace App\Entity;


use App\Repository\ConcertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\UX\Turbo\Attribute\Broadcast;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



#[ORM\Entity(repositoryClass: ConcertRepository::class)]
#[Broadcast]
#[Vich\Uploadable]



class Concert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_artiste = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToOne(inversedBy: 'concert', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?DateConcert $date_concert = null;

    #[ORM\ManyToOne(inversedBy: 'concerts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Scene $scene = null;

    #[ORM\ManyToOne(inversedBy: 'concerts')]
    private ?Musique $musique = null;

    #[Vich\UploadableField(mapping: 'concert_images', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'concert', targetEntity: ConcertPass::class)]
    private Collection $concertPasses;

    public function __construct()
    {
        $this->concertPasses = new ArrayCollection();
    }

    public function __toString()
    {
        // Retournez ici une propriété appropriée de l'objet Concert
        // Par exemple, si votre objet Concert a une propriété 'nom_artiste', vous pouvez faire :
        return $this->nom_artiste;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomArtiste(): ?string
    {
        return $this->nom_artiste;
    }

    public function setNomArtiste(string $nom_artiste): static
    {
        $this->nom_artiste = $nom_artiste;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateConcert(): ?DateConcert
    {
        return $this->date_concert;
    }

    public function setDateConcert(DateConcert $date_concert): static
    {
        $this->date_concert = $date_concert;

        return $this;
    }

    public function getScene(): ?Scene
    {
        return $this->scene;
    }

    public function setScene(?Scene $scene): static
    {
        $this->scene = $scene;

        return $this;
    }

    public function getMusique(): ?Musique
    {
        return $this->musique;
    }

    public function setMusique(?Musique $musique): static
    {
        $this->musique = $musique;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return Collection<int, ConcertPass>
     */
    public function getConcertPasses(): Collection
    {
        return $this->concertPasses;
    }

    public function addConcertPass(ConcertPass $concertPass): self
    {
        if (!$this->concertPasses->contains($concertPass)) {
            $this->concertPasses[] = $concertPass;
            $concertPass->setConcert($this);
        }

        return $this;
    }

    public function removeConcertPass(ConcertPass $concertPass): self
    {
        if ($this->concertPasses->removeElement($concertPass)) {
            // set the owning side to null (unless already changed)
            if ($concertPass->getConcert() === $this) {
                $concertPass->setConcert(null);
            }
        }

        return $this;
    }
}