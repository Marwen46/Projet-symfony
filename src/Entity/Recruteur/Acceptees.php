<?php
namespace App\Entity\Recruteur;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\AccepteesRepository;

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
     * @ORM\Column(type="date")
     */
    private $DateRendezVous;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDateRendezVous(): ?string
    {
        return $this->DateRendezVous;
    }

    public function setDateRenderVous(string $DateRendezVous): self
    {
        $this->DateRendezVous = $DateRendezVous;

        return $this;
    }
}
