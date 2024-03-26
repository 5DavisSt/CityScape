<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTraits;
use App\Repository\AmenityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AmenityRepository::class)]
class Amenity
{
    use TimestampTraits;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $amenDishwasher = null;

    #[ORM\Column]
    private ?bool $amenFloorCoverings = null;

    #[ORM\Column]
    private ?bool $amenInternet = null;

    #[ORM\Column]
    private ?bool $amenWardrobes = null;

    #[ORM\Column]
    private ?bool $amenSupermarket = null;

    #[ORM\Column]
    private ?bool $amenKidsZone = null;

    #[ORM\OneToOne(mappedBy: 'propAmenity', cascade: ['persist', 'remove'])]
    private ?Property $amenProperty = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAmenDishwasher(): ?bool
    {
        return $this->amenDishwasher;
    }

    public function setAmenDishwasher(bool $amenDishwasher): static
    {
        $this->amenDishwasher = $amenDishwasher;

        return $this;
    }

    public function isAmenFloorCoverings(): ?bool
    {
        return $this->amenFloorCoverings;
    }

    public function setAmenFloorCoverings(bool $amenFloorCoverings): static
    {
        $this->amenFloorCoverings = $amenFloorCoverings;

        return $this;
    }

    public function isAmenInternet(): ?bool
    {
        return $this->amenInternet;
    }

    public function setAmenInternet(bool $amenInternet): static
    {
        $this->amenInternet = $amenInternet;

        return $this;
    }

    public function isAmenWardrobes(): ?bool
    {
        return $this->amenWardrobes;
    }

    public function setAmenWardrobes(bool $amenWardrobes): static
    {
        $this->amenWardrobes = $amenWardrobes;

        return $this;
    }

    public function isAmenSupermarket(): ?bool
    {
        return $this->amenSupermarket;
    }

    public function setAmenSupermarket(bool $amenSupermarket): static
    {
        $this->amenSupermarket = $amenSupermarket;

        return $this;
    }

    public function isAmenKidsZone(): ?bool
    {
        return $this->amenKidsZone;
    }

    public function setAmenKidsZone(bool $amenKidsZone): static
    {
        $this->amenKidsZone = $amenKidsZone;

        return $this;
    }

    public function getAmenProperty(): ?Property
    {
        return $this->amenProperty;
    }

    public function setAmenProperty(?Property $amenProperty): static
    {
        // unset the owning side of the relation if necessary
        if ($amenProperty === null && $this->amenProperty !== null) {
            $this->amenProperty->setPropAmenity(null);
        }

        // set the owning side of the relation if necessary
        if ($amenProperty !== null && $amenProperty->getPropAmenity() !== $this) {
            $amenProperty->setPropAmenity($this);
        }

        $this->amenProperty = $amenProperty;

        return $this;
    }
}
