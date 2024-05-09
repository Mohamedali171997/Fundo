<?php

namespace App\Entity;

use App\Repository\DonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DonRepository::class)]
class Don
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Montant cannot be blank")]
    #[Assert\Type(type: 'float', message: "Montant must be a valid number")]
    #[Assert\PositiveOrZero(message: "Montant must be a positive number or zero")]
    private ?float $montant = null;
    

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Projet cannot be blank")]
    #[Assert\Length(
        max: 255,
        maxMessage: "Projet cannot be longer than {{ limit }} characters"
    )]
    private ?string $projet = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Type de Don cannot be blank")]
    #[Assert\Length(
        max: 255,
        maxMessage: "Type de Don cannot be longer than {{ limit }} characters"
    )]
    private ?string $typeDon = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Donateur cannot be blank")]
    #[Assert\Length(
        max: 255,
        maxMessage: "Donateur cannot be longer than {{ limit }} characters"
    )]
    private ?string $donateur = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Beneficiaire cannot be blank")]
    #[Assert\Length(
        max: 255,
        maxMessage: "Beneficiaire cannot be longer than {{ limit }} characters"
    )]
    private ?string $beneficiaire = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "Date cannot be blank")]
    #[Assert\Type("\DateTimeInterface", message: "Date must be a valid date")]
    #[Assert\LessThanOrEqual("today", message: "Date cannot be in the future")]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;
        return $this;
    }

    public function getProjet(): ?string
    {
        return $this->projet;
    }

    public function setProjet(string $projet): self
    {
        $this->projet = $projet;
        return $this;
    }

    public function getTypeDon(): ?string
    {
        return $this->typeDon;
    }

    public function setTypeDon(string $typeDon): self
    {
        $this->typeDon = $typeDon;
        return $this;
    }

    public function getDonateur(): ?string
    {
        return $this->donateur;
    }

    public function setDonateur(string $donateur): self
    {
        $this->donateur = $donateur;
        return $this;
    }

    public function getBeneficiaire(): ?string
    {
        return $this->beneficiaire;
    }

    public function setBeneficiaire(string $beneficiaire): self
    {
        $this->beneficiaire = $beneficiaire;
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }
}
