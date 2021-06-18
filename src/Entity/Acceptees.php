<?php

namespace App\Entity;

use App\Repository\AccepteesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccepteesRepository::class)
 */
class Acceptees
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Offre;

    /**
     * @ORM\Column(type="date")
     */
    private $DateRendezVous;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getOffre(): ?string
    {
        return $this->Offre;
    }

    public function setOffre(string $Offre): self
    {
        $this->Offre = $Offre;

        return $this;
    }

    public function getDateRendezVous(): ?\DateTimeInterface
    {
        return $this->DateRendezVous;
    }

    public function setDateRendezVous(\DateTimeInterface $DateRendezVous): self
    {
        $this->DateRendezVous = $DateRendezVous;

        return $this;
    }
}
