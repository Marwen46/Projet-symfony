<?php
namespace App\Entity\Candidat;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\CandidatCandidatureRepository;

/**
 * @ORM\Entity(repositoryClass=CandidatureRepository::class)
 */
class Candidature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Nom;
    /**
     * @ORM\Column(type="integer")
     */
    private $Telephone;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="integer")
     */
    private $Age;
    /**
     * @ORM\Column(type="integer")
     */
    private $CandidatId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Experience;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CvFilename;

    public function getId(): ?int
    {
        return $this->id;
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
    public function getCvFilename(): ?string
    {
        return $this->CvFilename;
    }

    public function setCvFilename(string $CvFilename): self
    {
        $this->CvFilename = $CvFilename;

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

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }
    public function getTelephone(): ?int
    {
        return $this->Telephone;
    }

    public function setTelephone(int $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }
    public function getCandidatId(): ?int
    {
        return $this->CandidatId;
    }

    public function setCandidatId(int $CandidatId): self
    {
        $this->CandidatId = $CandidatId;

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
}
