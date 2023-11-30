<?php

namespace App\Entity;
use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_f = null;

    #[ORM\Column]
    private ?int $id_c = null;

    #[ORM\OneToOne(inversedBy: 'facture', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'id_res', referencedColumnName: 'id_res', nullable: false)]
    private ?Reservation $reservation = null;


    public function getId_f(): ?int
    {
        return $this->id_f;
    }

    public function getIdC(): ?int
    {
        return $this->id_c;
    }

    public function setIdC(int $id_c): static
    {
        $this->id_c = $id_c;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }




  
}
