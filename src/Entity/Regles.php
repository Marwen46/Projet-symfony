<?php

namespace App\Entity;

use App\Repository\ReglesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReglesRepository::class)
 */
class Regles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $limitePostulation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getLimitePostulation(): ?int
    {
        return $this->limitePostulation;
    }

    public function setLimitePostulation(?int $limitePostulation): self
    {
        $this->limitePostulation = $limitePostulation;

        return $this;
    }
}
