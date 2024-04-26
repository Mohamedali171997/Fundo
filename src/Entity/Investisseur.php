<?php

namespace App\Entity;

use App\Repository\InvestisseurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: InvestisseurRepository::class)]
class Investisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom ne peut pas être vide")]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'email ne peut pas être vide")]
    #[Assert\Email(message: "L'email '{{ value }}' n'est pas une adresse email valide.")]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le compte bancaire ne peut pas être vide")]
    private ?int $compteBancaire = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'adresse ne peut pas être vide")]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le contact ne peut pas être vide")]
    private ?string $contact = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le secteur d'intérêt ne peut pas être vide")]
    private ?string $secteurInteret = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le montant d'investissement minimum ne peut pas être vide")]
    private ?int $montantInvestissementMinimum = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'historique des investissements ne peut pas être vide")]
    private ?string $historiqueInvestissements = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le montant investi ne peut pas être vide")]
    private ?int $montantInvesti = null;

    const SECTEUR_INTERET = [
        'Technologie' => 10000,
        'Science'=> 15000,
        'Environnement'=>20000,
        'Éducation' => 25000,
        'Santé' => 30000,
        'Art' => 35000,
    ];

  
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getCompteBancaire(): ?int
    {
        return $this->compteBancaire;
    }

    public function setCompteBancaire(int $compteBancaire): self
    {
        $this->compteBancaire = $compteBancaire;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;
        return $this;
    }

    public function getSecteurInteret(): ?string
    {
        return $this->secteurInteret;
    }

    public function setSecteurInteret(string $secteurInteret): self
    {
        if (!array_key_exists($secteurInteret, self::SECTEUR_INTERET)) {
            throw new \InvalidArgumentException('Secteur d\'intérêt invalide');
        }
    
        $this->secteurInteret = $secteurInteret;
        $this->montantInvestissementMinimum = self::SECTEUR_INTERET[$secteurInteret];
    
        return $this;
    }

    public function getMontantInvestissementMinimum(): ?int
    {
        return $this->montantInvestissementMinimum;
    }

    public function setMontantInvestissementMinimum(int $montantInvestissementMinimum): self
    {
        $this->montantInvestissementMinimum = $montantInvestissementMinimum;
        return $this;
    }

    public function getHistoriqueInvestissements(): ?string
    {
        return $this->historiqueInvestissements;
    }

    public function setHistoriqueInvestissements(string $historiqueInvestissements): self
    {
        $this->historiqueInvestissements = $historiqueInvestissements;
        return $this;
    }

    public function getMontantInvesti(): ?int
    {
        return $this->montantInvesti;
    }

    public function setMontantInvesti(int $montantInvesti): self
    {
        $this->montantInvesti = $montantInvesti;
        return $this;
    }


}

