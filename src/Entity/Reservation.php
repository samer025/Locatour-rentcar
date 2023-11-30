<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_res = null;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    /**
 * @Assert\GreaterThanOrEqual(value="today", message="La date de début ne peut pas être antérieure à aujourd'hui.")
 */
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    /**
     * @Assert\Expression(
     *     "this.getDateFin() >= this.getDateDebut()",
     *     message="La date de fin doit être ultérieure à la date de début."
     * )
     */
     private ?\DateTimeInterface $date_fin = null;

    #[ORM\OneToOne(mappedBy: 'reservation', targetEntity: Facture::class)]
    private ?Facture $facture = null;

    #[ORM\OneToOne(inversedBy: 'reservation', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'id_v', referencedColumnName: 'id_v', nullable: false)]
    private ?Voiture $id_v = null;

    #[ORM\OneToOne(inversedBy: 'reservation', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'id_cl', referencedColumnName: 'id', nullable: false)]
    private ?Utilisateur $id_cl;


    public function getId_res(): ?int
    {
        return $this->id_res;
    }
    

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

   /* public function getFacture(): ?Facture
    {
        return $this->facture;
    }*/

    /*public function setFacture(?Facture $facture): static
    {
        $this->facture = $facture;

        return $this;
    }*/

    public function getIdV(): ?Voiture
    {
        return $this->id_v;
    }

    public function setIdv(?Voiture $id_v): static
    {
        $this->id_v = $id_v;

        return $this;
    }
    

    public function getIdCl(): ?Utilisateur
    {
        return $this->id_cl;
    }

    public function setIdCl(?Utilisateur $id_cl): static
    {
        $this->id_cl = $id_cl;

        return $this;
    }
    public function __toString()
    {
        return $this->id_res;
    }
    
}
