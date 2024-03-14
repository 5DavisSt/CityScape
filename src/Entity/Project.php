<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTraits;
use App\Repository\ProjectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
	use TimestampTraits;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $projTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $projClient = null;

    #[ORM\Column]
    private ?int $projPrice = null;

    #[ORM\Column]
    private ?array $projCategory = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $projDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $projFacebook = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $projTwitter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $projLinkedin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $projInstagram = null;

    public function getId(): ?int
    {
        return $this->id;
    }
	
    public function getProjTitle(): ?string
    {
        return $this->projTitle;
    }

    public function setProjTitle(string $projTitle): static
    {
        $this->projTitle = $projTitle;

        return $this;
    }

    public function getProjClient(): ?string
    {
        return $this->projClient;
    }

    public function setProjClient(string $projClient): static
    {
        $this->projClient = $projClient;

        return $this;
    }

    public function getProjPrice(): ?int
    {
        return $this->projPrice;
    }

    public function setProjPrice(int $projPrice): static
    {
        $this->projPrice = $projPrice;

        return $this;
    }

    public function getProjCategory(): ?array
    {
        return $this->projCategory;
    }

    public function setProjCategory(array $projCategory): static
    {
        $this->projCategory = $projCategory;

        return $this;
    }

    public function getProjDate(): ?\DateTimeInterface
    {
        return $this->projDate;
    }

    public function setProjDate(\DateTimeInterface $projDate): static
    {
        $this->projDate = $projDate;

        return $this;
    }

    public function getProjFacebook(): ?string
    {
        return $this->projFacebook;
    }

    public function setProjFacebook(?string $projFacebook): static
    {
        $this->projFacebook = $projFacebook;

        return $this;
    }

    public function getProjTwitter(): ?string
    {
        return $this->projTwitter;
    }

    public function setProjTwitter(?string $projTwitter): static
    {
        $this->projTwitter = $projTwitter;

        return $this;
    }

    public function getProjLinkedin(): ?string
    {
        return $this->projLinkedin;
    }

    public function setProjLinkedin(?string $projLinkedin): static
    {
        $this->projLinkedin = $projLinkedin;

        return $this;
    }

    public function getProjInstagram(): ?string
    {
        return $this->projInstagram;
    }

    public function setProjInstagram(?string $projInstagram): static
    {
        $this->projInstagram = $projInstagram;

        return $this;
    }
}