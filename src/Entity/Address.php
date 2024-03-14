<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTraits;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
	use TimestampTraits;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $addNbStreet = null;

    #[ORM\Column(length: 255)]
    private ?string $addAddressLine1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addAddressLine2 = null;

    #[ORM\Column(length: 255)]
    private ?string $addCity = null;

    #[ORM\Column(length: 255)]
    private ?string $addState = null;

    #[ORM\Column]
    private ?int $addZip = null;

    #[ORM\Column(length: 255)]
    private ?string $addCountry = null;

    #[ORM\OneToOne(mappedBy: 'address', cascade: ['persist', 'remove'])]
    private ?Property $addProperty = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddNbStreet(): ?int
    {
        return $this->addNbStreet;
    }

    public function setAddNbStreet(int $addNbStreet): static
    {
        $this->addNbStreet = $addNbStreet;

        return $this;
    }

    public function getAddAddressLine1(): ?string
    {
        return $this->addAddressLine1;
    }

    public function setAddAddressLine1(string $addAddressLine1): static
    {
        $this->addAddressLine1 = $addAddressLine1;

        return $this;
    }

    public function getAddAddressLine2(): ?string
    {
        return $this->addAddressLine2;
    }

    public function setAddAddressLine2(?string $addAddressLine2): static
    {
        $this->addAddressLine2 = $addAddressLine2;

        return $this;
    }

    public function getAddCity(): ?string
    {
        return $this->addCity;
    }

    public function setAddCity(string $addCity): static
    {
        $this->addCity = $addCity;

        return $this;
    }

    public function getAddState(): ?string
    {
        return $this->addState;
    }

    public function setAddState(string $addState): static
    {
        $this->addState = $addState;

        return $this;
    }

    public function getAddZip(): ?int
    {
        return $this->addZip;
    }

    public function setAddZip(int $addZip): static
    {
        $this->addZip = $addZip;

        return $this;
    }
	
    public function getAddCountry(): ?string
    {
        return $this->addCountry;
    }

    public function setAddCountry(string $addCountry): static
    {
        $this->addCountry = $addCountry;

        return $this;
    }

    public function getAddProperty(): ?Property
    {
        return $this->addProperty;
    }

    public function setAddProperty(?Property $addProperty): static
    {
        // unset the owning side of the relation if necessary
        if ($addProperty === null && $this->addProperty !== null) {
            $this->addProperty->setPropAddress(null);
        }

        // set the owning side of the relation if necessary
        if ($addProperty !== null && $addProperty->getPropAddress() !== $this) {
            $addProperty->setPropAddress($this);
        }

        $this->addProperty = $addProperty;

        return $this;
    }
}