<?php

namespace App\Entity\Categorie;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use App\Entity\offreEmploi\OffreEmploi;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\Categorie\CategorieRepository;
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
     * @ORM\OneToMany(targetEntity=\App\Entity\offreEmploi\OffreEmploi::class, mappedBy="categorie",cascade={"persist", "remove"})
     * @JoinColumn(onDelete="CASCADE")
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
     * @return Collection|\App\Entity\offreEmploi\OffreEmploi[]
     */
    public function getOffreEmplois(): Collection
    {
        return $this->offreEmplois;
    }

    public function addOffreEmploi(\App\Entity\offreEmploi\OffreEmploi $offreEmploi): self
    {
        if (!$this->offreEmplois->contains($offreEmploi)) {
            $this->offreEmplois[] = $offreEmploi;
            $offreEmploi->setCategorie($this);
        }

        return $this;
    }

    public function removeOffreEmploi(\App\Entity\offreEmploi\OffreEmploi $offreEmploi): self
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
