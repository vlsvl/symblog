<?php

namespace App\Entity;

use App\Repository\ContractorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContractorRepository::class)]
class Contractor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $legal_type = null;

    #[ORM\Column(length: 12)]
    private ?string $inn = null;

    #[ORM\Column(length: 512)]
    private ?string $name = null;

    #[ORM\Column(length: 512)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $contact = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLegalType(): ?string
    {
        return $this->legal_type;
    }

    public function setLegalType(string $legal_type): static
    {
        $this->legal_type = $legal_type;

        return $this;
    }

    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function setInn(string $inn): static
    {
        $this->inn = $inn;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }
}
