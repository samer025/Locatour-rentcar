<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_v = null;

    #[ORM\Column(length: 255)] 
    private ?string $matricule = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column]
    private ?int $klm = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $annee = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\OneToOne(mappedBy: 'id_v', cascade: ['persist', 'remove'])]
    private ?Reservation $reservation = null;

    #[ORM\OneToOne(mappedBy: 'id_v', cascade: ['persist', 'remove'])]
    private ?FicheTechnique $ficheTechnique = null;

  

    public function getId_v(): ?int
    {
        return $this->id_v;
    }
   
    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getKlm(): ?int
    {
        return $this->klm;
    }

    public function setKlm(int $klm): static
    {
        $this->klm = $klm;

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

   
    
    public function __toString()
    {
        return  $this->modele;
    }

    public function getFicheTechnique(): ?FicheTechnique
    {
        return $this->ficheTechnique;
    }

    public function setFicheTechnique(?FicheTechnique $ficheTechnique): static
    {
        // unset the owning side of the relation if necessary
        if ($ficheTechnique === null && $this->ficheTechnique !== null) {
            $this->ficheTechnique->setIdV(null);
        }

        // set the owning side of the relation if necessary
        if ($ficheTechnique !== null && $ficheTechnique->getIdV() !== $this) {
            $ficheTechnique->setIdV($this);
        }

        $this->ficheTechnique = $ficheTechnique;

        return $this;
    }

  
}
