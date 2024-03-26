<?php

namespace App\Entity\Newsletter;

use App\Repository\Newsletter\NewsletterUserRepository;
use App\Entity\Traits\TimestampTraits;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsletterUserRepository::class)]
class NewsletterUser
{
    use TimestampTraits;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $newsUserEmail = null;

    #[ORM\Column]
    private ?bool $isRGPD = false;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $newsUserValidationToken = null;

    #[ORM\Column]
    private ?bool $isValid = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNewsUserEmail(): ?string
    {
        return $this->newsUserEmail;
    }

    public function setNewsUserEmail(?string $newsUserEmail): static
    {
        $this->newsUserEmail = $newsUserEmail;

        return $this;
    }

    public function isRGPD(): ?bool
    {
        return $this->isRGPD;
    }

    public function setIsRGPD(bool $isRGPD): static
    {
        $this->isRGPD = $isRGPD;

        return $this;
    }

    public function getNewsUserValidationToken(): ?string
    {
        return $this->newsUserValidationToken;
    }

    public function setNewsUserValidationToken(string $newsUserValidationToken): static
    {
        $this->newsUserValidationToken = $newsUserValidationToken;

        return $this;
    }

    public function isValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): static
    {
        $this->isValid = $isValid;

        return $this;
    }
}
