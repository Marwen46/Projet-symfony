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
     * @ORM\OneToMany(targetEntity=OffreEmploi::class, mappedBy="categorie")
     */
    private $offres;

    public function __construct()
    {
        $this->offres = new ArrayCollection();
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
     * @return Collection|OffreEmploi[]
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(OffreEmploi $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->setCategorie($this);
        }

        return $this;
    }

    public function removeOffre(OffreEmploi $offre): self
    {
        if ($this->offres->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getCategorie() === $this) {
                $offre->setCategorie(null);
            }
        }

        return $this;
    }
}
