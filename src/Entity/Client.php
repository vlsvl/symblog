<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $system_id = null;

    #[ORM\Column(length: 255)]
    private ?string $system_password = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $multysign_traffik_available = null;

    #[ORM\Column]
    private ?bool $international_traffik_available = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contractor $contractor_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSystemId(): ?string
    {
        return $this->system_id;
    }

    public function setSystemId(string $system_id): static
    {
        $this->system_id = $system_id;

        return $this;
    }

    public function getSystemPassword(): ?string
    {
        return $this->system_password;
    }

    public function setSystemPassword(string $system_password): static
    {
        $this->system_password = $system_password;

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

    public function isMultysignTraffikAvailable(): ?bool
    {
        return $this->multysign_traffik_available;
    }

    public function setMultysignTraffikAvailable(bool $multysign_traffik_available): static
    {
        $this->multysign_traffik_available = $multysign_traffik_available;

        return $this;
    }

    public function isInternationalTraffikAvailable(): ?bool
    {
        return $this->international_traffik_available;
    }

    public function setInternationalTraffikAvailable(bool $international_traffik_available): static
    {
        $this->international_traffik_available = $international_traffik_available;

        return $this;
    }

    public function getContractorId(): ?Contractor
    {
        return $this->contractor_id;
    }

    public function setContractorId(Contractor $contractor_id): static
    {
        $this->contractor_id = $contractor_id;

        return $this;
    }
}
