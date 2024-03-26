<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTraits;
use App\Repository\PictureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Stringable;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Picture implements Stringable
{
	use TimestampTraits;
	
	public function __toString(): string
	{
		return $this->picName;
	}
	
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'picName', size: 'picSize')]
    private ?File $picFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $picName = null;

    #[ORM\Column(nullable: true)]
    private ?int $picSize = null;

    #[ORM\ManyToOne(inversedBy: 'propPicture')]
    private ?Property $picProperty = null;
	
    public function getId(): ?int
    {
        return $this->id;
    }
	
	 /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
	
    public function getPicFile(): ?File
    {
        return $this->picFile;
    }
	
    public function setPicFile(?File $picFile = null): void
    {
        $this->picFile = $picFile;

        if (null !== $picFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getPicName(): ?string
    {
        return $this->picName;
    }

    public function setPicName(?string $picName): void
    {
        $this->picName = $picName;
    }

    public function getPicSize(): ?int
    {
        return $this->picSize;
    }
	
    public function setPicSize(?int $picSize): void
    {
        $this->picSize = $picSize;
    }

    public function getPicProperty(): ?Property
    {
        return $this->picProperty;
    }

    public function setPicProperty(?Property $picProperty): static
    {
        $this->picProperty = $picProperty;

        return $this;
    }
}
