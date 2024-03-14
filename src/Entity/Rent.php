<?php

namespace App\Entity;

use App\Repository\RentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentRepository::class)]
class Rent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $rentStart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $rentEnd = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $rentPrice = null;

    #[ORM\ManyToOne(inversedBy: 'rent')]
    private ?User $rentUser = null;

    #[ORM\ManyToOne(inversedBy: 'rent')]
    private ?Property $rentProperty = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRentStart(): ?\DateTimeInterface
    {
        return $this->rentStart;
    }

    public function setRentStart(\DateTimeInterface $rentStart): static
    {
        $this->rentStart = $rentStart;

        return $this;
    }

    public function getRentEnd(): ?\DateTimeInterface
    {
        return $this->rentEnd;
    }

    public function setRentEnd(\DateTimeInterface $rentEnd): static
    {
        $this->rentEnd = $rentEnd;

        return $this;
    }

    public function getRentPrice(): ?string
    {
        return $this->rentPrice;
    }

    public function setRentPrice(string $rentPrice): static
    {
        $this->rentPrice = $rentPrice;

        return $this;
    }

    public function getRentUser(): ?User
    {
        return $this->rentUser;
    }

    public function setRentUser(?User $rentUser): static
    {
        $this->rentUser = $rentUser;

        return $this;
    }
	
    public function getRentProperty(): ?Property
    {
        return $this->rentProperty;
    }

    public function setRentProperty(?Property $rentProperty): static
    {
        $this->rentProperty = $rentProperty;

        return $this;
    }
}
