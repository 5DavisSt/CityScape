<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $add_nb_street = null;

    #[ORM\Column(length: 255)]
    private ?string $add_address_line_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $add_address_line_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $add_city = null;

    #[ORM\Column(length: 255)]
    private ?string $add_state = null;

    #[ORM\Column]
    private ?int $add_zip = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Property $add_property = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $add_country = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddNbStreet(): ?int
    {
        return $this->add_nb_street;
    }

    public function setAddNbStreet(int $add_nb_street): static
    {
        $this->add_nb_street = $add_nb_street;

        return $this;
    }

    public function getAddAddressLine1(): ?string
    {
        return $this->add_address_line_1;
    }

    public function setAddAddressLine1(string $add_address_line_1): static
    {
        $this->add_address_line_1 = $add_address_line_1;

        return $this;
    }

    public function getAddAddressLine2(): ?string
    {
        return $this->add_address_line_2;
    }

    public function setAddAddressLine2(?string $add_address_line_2): static
    {
        $this->add_address_line_2 = $add_address_line_2;

        return $this;
    }

    public function getAddCity(): ?string
    {
        return $this->add_city;
    }

    public function setAddCity(string $add_city): static
    {
        $this->add_city = $add_city;

        return $this;
    }

    public function getAddState(): ?string
    {
        return $this->add_state;
    }

    public function setAddState(string $add_state): static
    {
        $this->add_state = $add_state;

        return $this;
    }

    public function getAddZip(): ?int
    {
        return $this->add_zip;
    }

    public function setAddZip(int $add_zip): static
    {
        $this->add_zip = $add_zip;

        return $this;
    }

    public function getAddProperty(): ?Property
    {
        return $this->add_property;
    }

    public function setAddProperty(Property $add_property): static
    {
        $this->add_property = $add_property;

        return $this;
    }

    public function getAddCountry(): ?Country
    {
        return $this->add_country;
    }

    public function setAddCountry(?Country $add_country): static
    {
        $this->add_country = $add_country;

        return $this;
    }
}
