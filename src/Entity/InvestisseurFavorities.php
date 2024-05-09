<?php

namespace App\Entity;

use App\Repository\InvestisseurFavoritiesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvestisseurFavoritiesRepository::class)]
class InvestisseurFavorities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column]
    private ?int $investisseur_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getInvestisseurId(): ?int
    {
        return $this->investisseur_id;
    }

    public function setInvestisseurId(int $investisseur_id): static
    {
        $this->investisseur_id = $investisseur_id;

        return $this;
    }
}
