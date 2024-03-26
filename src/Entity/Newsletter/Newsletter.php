<?php

namespace App\Entity\Newsletter;

use App\Repository\Newsletter\NewsletterRepository;
use App\Entity\Traits\TimestampTraits;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsletterRepository::class)]
class Newsletter
{
    use TimestampTraits;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $newsTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $newsContent = null;

    #[ORM\Column]
    private ?bool $isSent = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNewsTitle(): ?string
    {
        return $this->newsTitle;
    }

    public function setNewsTitle(string $newsTitle): static
    {
        $this->newsTitle = $newsTitle;

        return $this;
    }

    public function getNewsContent(): ?string
    {
        return $this->newsContent;
    }

    public function setNewsContent(string $newsContent): static
    {
        $this->newsContent = $newsContent;

        return $this;
    }

    public function isSent(): ?bool
    {
        return $this->isSent;
    }

    public function setIsSent(bool $isSent): static
    {
        $this->isSent = $isSent;

        return $this;
    }
}
