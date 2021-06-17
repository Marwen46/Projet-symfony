<?php

namespace App\Entity\offreEmploi;

use App\Entity\Recruteur\Recruteur;
use DateTime;
use DateTimeInterface;
use App\Entity\Timestamps;
use Webmozart\Assert\Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Categorie\Categorie;
use Doctrine\ORM\Mapping\JoinColumn;
use App\Repository\offreEmploi\OffreEmploiRepository;
/**
 * @ORM\Entity(repositoryClass=OffreEmploiRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class OffreEmploi
{   use Timestamps;


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $Experience;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Emplacement;

    /**
     * @ORM\Column(type="string")
     */
    private $TypeContrat;

    /**
     * @ORM\Column(type="date")
     */
    private $DateExpiration;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="offreEmplois",cascade={"persist"})
     * @JoinColumn(onDelete="CASCADE")
     */
    private $categorie;



   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->Experience;
    }

    public function setExperience(string $Experience): self
    {
        $this->Experience = $Experience;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->Emplacement;
    }

    public function setEmplacement(?string $Emplacement): self
    {
        $this->Emplacement = $Emplacement;

        return $this;
    }

    public function getTypeContrat(): ?String
    {
        return $this->TypeContrat;
    }

    public function setTypeContrat(String $TypeContrat): self
    {
        $this->TypeContrat = $TypeContrat;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->DateExpiration;
    }

    public function setDateExpiration(\DateTimeInterface $DateExpiration): self
    {
        $this->DateExpiration = $DateExpiration;

        return $this;
    }


    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getRecruteur(): ?Recruteur
    {
        return $this->recruteur;
    }

    public function setRecruteur(?Recruteur $recruteur): self
    {
        $this->recruteur = $recruteur;

        return $this;
    }

  
}
