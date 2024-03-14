<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTraits;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
	use TimestampTraits;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $catName = null;

    #[ORM\Column(length: 255)]
    private ?string $catSlug = null;

    #[ORM\Column(length: 255)]
    private ?string $catMetaTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $catMetaDescription = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'categories')]
    private ?self $parent = null;

    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    private Collection $categories;

    #[ORM\OneToMany(targetEntity: Property::class, mappedBy: 'category')]
    private Collection $catProperties;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->catProperties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatName(): ?string
    {
        return $this->catName;
    }

    public function setCatName(string $catName): static
    {
        $this->catName = $catName;

        return $this;
    }

    public function getCatSlug(): ?string
    {
        return $this->catSlug;
    }

    public function setCatSlug(string $catSlug): static
    {
        $this->catSlug = $catSlug;

        return $this;
    }

    public function getCatMetaTitle(): ?string
    {
        return $this->catMetaTitle;
    }

    public function setCatMetaTitle(string $catMetaTitle): static
    {
        $this->catMetaTitle = $catMetaTitle;

        return $this;
    }

    public function getCatMetaDescription(): ?string
    {
        return $this->catMetaDescription;
    }

    public function setCatMetaDescription(string $catMetaDescription): static
    {
        $this->catMetaDescription = $catMetaDescription;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(self $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setParent($this);
        }

        return $this;
    }

    public function removeCategory(self $category): static
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getParent() === $this) {
                $category->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Property>
     */
    public function getCatProperties(): Collection
    {
        return $this->catProperties;
    }

    public function addCatProperty(Property $catProperty): static
    {
        if (!$this->catProperties->contains($catProperty)) {
            $this->catProperties->add($catProperty);
            $catProperty->setPropCategory($this);
        }

        return $this;
    }

    public function removeCatProperty(Property $catProperty): static
    {
        if ($this->catProperties->removeElement($catProperty)) {
            // set the owning side to null (unless already changed)
            if ($catProperty->getPropCategory() === $this) {
                $catProperty->setPropCategory(null);
            }
        }

        return $this;
    }
}
