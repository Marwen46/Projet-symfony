<?php

namespace App\Entity\Categorie;

use App\Entity\Candidat\Candidat;
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

    /**
     * @ORM\OneToMany(targetEntity=Candidat::class, mappedBy="categorie")
     */
    private $candidats;

    public function __construct()
    {
        $this->offreEmplois = new ArrayCollection();
        $this->candidats = new ArrayCollection();
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
    
    /**
     * @return Collection|Candidat[]
     */
    public function getCandidats(): Collection
    {
        return $this->candidats;
    }
    
    public function addCandidat(Candidat $candidat): self
    {
        if (!$this->candidats->contains($candidat)) {
            $this->candidats[] = $candidat;
            $candidat->setCategorie($this);
        }
        
        return $this;
    }
    
    public function removeCandidat(Candidat $candidat): self
    {
        if ($this->candidats->removeElement($candidat)) {
            // set the owning side to null (unless already changed)
            if ($candidat->getCategorie() === $this) {
                $candidat->setCategorie(null);
            }
        }
        
        return $this;
    }
    
    public function __toString()
    {
        return $this->nomCategorie;
    }

   
}
