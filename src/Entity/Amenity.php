<?php

namespace App\Entity;

use App\Repository\AmenityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AmenityRepository::class)]
class Amenity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $amen_dishwasher = null;

    #[ORM\Column]
    private ?bool $amen_floor_coverings = null;

    #[ORM\Column]
    private ?bool $amen_internet = null;

    #[ORM\Column]
    private ?bool $amen_wardrobes = null;

    #[ORM\Column]
    private ?bool $amen_supermarket = null;

    #[ORM\Column]
    private ?bool $amen_kids_zone = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Property $amen_property = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAmenDishwasher(): ?bool
    {
        return $this->amen_dishwasher;
    }

    public function setAmenDishwasher(bool $amen_dishwasher): static
    {
        $this->amen_dishwasher = $amen_dishwasher;

        return $this;
    }

    public function isAmenFloorCoverings(): ?bool
    {
        return $this->amen_floor_coverings;
    }

    public function setAmenFloorCoverings(bool $amen_floor_coverings): static
    {
        $this->amen_floor_coverings = $amen_floor_coverings;

        return $this;
    }

    public function isAmenInternet(): ?bool
    {
        return $this->amen_internet;
    }

    public function setAmenInternet(bool $amen_internet): static
    {
        $this->amen_internet = $amen_internet;

        return $this;
    }

    public function isAmenWardrobes(): ?bool
    {
        return $this->amen_wardrobes;
    }

    public function setAmenWardrobes(bool $amen_wardrobes): static
    {
        $this->amen_wardrobes = $amen_wardrobes;

        return $this;
    }

    public function isAmenSupermarket(): ?bool
    {
        return $this->amen_supermarket;
    }

    public function setAmenSupermarket(bool $amen_supermarket): static
    {
        $this->amen_supermarket = $amen_supermarket;

        return $this;
    }

    public function isAmenKidsZone(): ?bool
    {
        return $this->amen_kids_zone;
    }

    public function setAmenKidsZone(bool $amen_kids_zone): static
    {
        $this->amen_kids_zone = $amen_kids_zone;

        return $this;
    }

    public function getAmenProperty(): ?Property
    {
        return $this->amen_property;
    }

    public function setAmenProperty(Property $amen_property): static
    {
        $this->amen_property = $amen_property;

        return $this;
    }
}
