<?php

namespace App\Entity;

use App\Repository\FicheTechniqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheTechniqueRepository::class)]
class FicheTechnique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_ft = null;

    

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $tax = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $assurence = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $visite_tech = null;

    #[ORM\Column(length: 255)]
    private ?string $vidange = null;

    #[ORM\OneToOne(inversedBy: 'ficheTechnique', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'id_v', referencedColumnName: 'id_v', nullable: false)]
    private ?Voiture $id_v = null;

  

    public function getId(): ?int
    {
        return $this->id_ft;
    }

    

    

    public function getTax(): ?\DateTimeInterface
    {
        return $this->tax;
    }

    public function setTax(\DateTimeInterface $tax): static
    {
        $this->tax = $tax;

        return $this;
    }

    public function getAssurence(): ?\DateTimeInterface
    {
        return $this->assurence;
    }

    public function setAssurence(\DateTimeInterface $assurence): static
    {
        $this->assurence = $assurence;

        return $this;
    }

    public function getVisiteTech(): ?\DateTimeInterface
    {
        return $this->visite_tech;
    }

    public function setVisiteTech(\DateTimeInterface $visite_tech): static
    {
        $this->visite_tech = $visite_tech;

        return $this; 
    }

    public function getVidange(): ?string
    {
        return $this->vidange;
    }

    public function setVidange(string $vidange): static
    {
        $this->vidange = $vidange;

        return $this;
    }

    public function getIdV(): ?Voiture
    {
        return $this->id_v;
    }

    public function setIdV(?Voiture $id_v): static
    {
        $this->id_v = $id_v;

        return $this;
    }

   
}
