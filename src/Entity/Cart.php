<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTraits;
use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    use TimestampTraits;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $stripeId = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    private ?User $cartUser = null;

    #[ORM\ManyToMany(targetEntity: Property::class, inversedBy: 'carts')]
    private Collection $cartProperty;

    public function __construct()
    {
        $this->cartProperty = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStripeId(): ?int
    {
        return $this->stripeId;
    }

    public function setStripeId(int $stripeId): static
    {
        $this->stripeId = $stripeId;

        return $this;
    }

    public function getCartUser(): ?User
    {
        return $this->cartUser;
    }

    public function setCartUser(?User $cartUser): static
    {
        $this->cartUser = $cartUser;

        return $this;
    }

    /**
     * @return Collection<int, Property>
     */
    public function getCartProperty(): Collection
    {
        return $this->cartProperty;
    }

    public function addCartProperty(Property $cartProperty): static
    {
        if (!$this->cartProperty->contains($cartProperty)) {
            $this->cartProperty->add($cartProperty);
        }

        return $this;
    }

    public function removeCartProperty(Property $cartProperty): static
    {
        $this->cartProperty->removeElement($cartProperty);

        return $this;
    }
}
