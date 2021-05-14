<?php

namespace App\Entity\Categorie;

use App\Repository\Categorie\CategorieRepository;
use App\Entity\offreEmploi\OffreEmploi;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nomCategorie;

    /**
     * @ORM\OneToMany(targetEntity=\App\Entity\OffreEmploi\OffreEmploi::class, mappedBy="gategorie")
     */
    private $offreEmplois;

    public function __construct()
    {
        $this->offreEmplois = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): self
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * @return Collection|\App\Entity\OffreEmploi\OffreEmploi[]
     */
    public function getOffreEmplois(): Collection
    {
        return $this->offreEmplois;
    }

    public function addOffreEmploi(\App\Entity\OffreEmploi\OffreEmploi $offreEmploi): self
    {
        if (!$this->offreEmplois->contains($offreEmploi)) {
            $this->offreEmplois[] = $offreEmploi;
            $offreEmploi->setCategorie($this);
        }

        return $this;
    }

    public function removeOffreEmploi(\App\Entity\OffreEmploi\OffreEmploi $offreEmploi): self
    {
        if ($this->offreEmplois->removeElement($offreEmploi)) {
            // set the owning side to null (unless already changed)
            if ($offreEmploi->getCategorie() === $this) {
                $offreEmploi->setCategorie(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nomCategorie;
    }


   
}
