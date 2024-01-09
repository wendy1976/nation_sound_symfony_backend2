<?php

namespace App\Entity;

use App\Repository\PassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: PassRepository::class)]
#[Broadcast]
class Pass
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_pass = null;

    #[ORM\Column(length: 255)]
    private ?string $description_pass = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prix_pass = null;

    #[ORM\OneToMany(mappedBy: 'pass', targetEntity: ConcertPass::class)]
    private Collection $concertPasses;

    public function __construct()
    {
        $this->concertPasses = new ArrayCollection();
    }

    public function __toString()
    {
        // Retournez ici une propriété appropriée de l'objet Pass
        // Par exemple, si votre objet Pass a une propriété 'nom_pass', vous pouvez faire :
        return $this->nom_pass;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPass(): ?string
    {
        return $this->nom_pass;
    }

    public function setNomPass(string $nom_pass): static
    {
        $this->nom_pass = $nom_pass;

        return $this;
    }

    public function getDescriptionPass(): ?string
    {
        return $this->description_pass;
    }

    public function setDescriptionPass(string $description_pass): static
    {
        $this->description_pass = $description_pass;

        return $this;
    }

    public function getPrixPass(): ?string
    {
        return $this->prix_pass;
    }

    public function setPrixPass(string $prix_pass): static
    {
        $this->prix_pass = $prix_pass;

        return $this;
    }

    /**
     * @return Collection<int, ConcertPass>
     */
    public function getConcertPasses(): Collection
    {
        return $this->concertPasses;
    }

    public function addConcertPass(ConcertPass $concertPass): static
    {
        if (!$this->concertPasses->contains($concertPass)) {
            $this->concertPasses->add($concertPass);
            $concertPass->setPass($this);
        }

        return $this;
    }

    public function removeConcertPass(ConcertPass $concertPass): static
    {
        if ($this->concertPasses->removeElement($concertPass)) {
            // set the owning side to null (unless already changed)
            if ($concertPass->getPass() === $this) {
                $concertPass->setPass(null);
            }
        }

        return $this;
    }
}