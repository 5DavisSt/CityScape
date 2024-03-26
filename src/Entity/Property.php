<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTraits;
use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use GuzzleHttp\Client;
use Geocoder\Provider\Photon\Photon;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Property
{
    use TimestampTraits;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $propTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $propHousingType = null;

    #[ORM\Column]
    private ?int $propNbRooms = null;

    #[ORM\Column]
    private ?int $propSQM = null;

    #[ORM\Column]
    private ?int $propPrice = null;

    #[ORM\Column(nullable: true)]
    private ?int $propNbBeds = null;

    #[ORM\Column(nullable: true)]
    private ?int $propNbBaths = null;

    #[ORM\Column(nullable: true)]
    private ?int $propNbSpaces = null;

    #[ORM\Column(nullable: true)]
    private ?bool $propFurnished = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $propFeature = null;

    #[ORM\Column]
    private ?float $propLatitude = null;

    #[ORM\Column]
    private ?float $propLongitude = null;

    #[ORM\Column(length: 255)]
    private ?string $propSlug = null;

    #[ORM\OneToMany(targetEntity: Picture::class, mappedBy: 'picProperty', cascade: ['persist', 'remove'])]
    private Collection $propPicture;

    #[ORM\ManyToOne(inversedBy: 'catProperties')]
    private ?Category $propCategory = null;

    #[ORM\OneToOne(inversedBy: 'amenProperty', cascade: ['persist', 'remove'])]
    private ?Amenity $propAmenity = null;

    #[ORM\OneToOne(inversedBy: 'addProperty', cascade: ['persist', 'remove'])]
    private ?Address $propAddress = null;

    #[ORM\OneToMany(targetEntity: Rent::class, mappedBy: 'rentProperty')]
    private Collection $propRent;

    #[ORM\Column(type: Types::OBJECT, nullable: true)]
    private ?object $geocoder = null;

    public function __construct()
    {
        $this->propPicture = new ArrayCollection();
        $this->propRent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPropTitle(): ?string
    {
        return $this->propTitle;
    }

    public function setPropTitle(string $propTitle): static
    {
        $this->propTitle = $propTitle;

        return $this;
    }

    public function getPropHousingType(): ?string
    {
        return $this->propHousingType;
    }

    public function setPropHousingType(string $propHousingType): static
    {
        $this->propHousingType = $propHousingType;

        return $this;
    }

    public function getPropNbRooms(): ?int
    {
        return $this->propNbRooms;
    }

    public function setPropNbRooms(int $propNbRooms): static
    {
        $this->propNbRooms = $propNbRooms;

        return $this;
    }

    public function getPropSQM(): ?int
    {
        return $this->propSQM;
    }

    public function setPropSQM(int $propSQM): static
    {
        $this->propSQM = $propSQM;

        return $this;
    }

    public function getPropPrice(): ?int
    {
        return $this->propPrice;
    }

    public function setPropPrice(int $propPrice): static
    {
        $this->propPrice = $propPrice;

        return $this;
    }

    public function getPropNbBeds(): ?int
    {
        return $this->propNbBeds;
    }

    public function setPropNbBeds(int $propNbBeds): static
    {
        $this->propNbBeds = $propNbBeds;

        return $this;
    }

    public function getPropNbBaths(): ?int
    {
        return $this->propNbBaths;
    }

    public function setPropNbBaths(int $propNbBaths): static
    {
        $this->propNbBaths = $propNbBaths;

        return $this;
    }

    public function getPropNbSpaces(): ?int
    {
        return $this->propNbSpaces;
    }

    public function setPropNbSpaces(int $propNbSpaces): static
    {
        $this->propNbSpaces = $propNbSpaces;

        return $this;
    }

    public function isPropFurnished(): ?bool
    {
        return $this->propFurnished;
    }

    public function setPropFurnished(?bool $propFurnished): static
    {
        $this->propFurnished = $propFurnished;

        return $this;
    }
	
    public function getPropFeature(): ?array
    {
        return $this->propFeature;
    }

    public function setPropFeature(?array $propFeature): static
    {
        $this->propFeature = $propFeature;

        return $this;
    }

    public function getPropLatitude(): ?float
    {
        return $this->propLatitude;
    }

    public function setPropLatitude(float $propLatitude): static
    {
        $this->propLatitude = $propLatitude;

        return $this;
    }

    public function getPropLongitude(): ?float
    {
        return $this->propLongitude;
    }

    public function setPropLongitude(float $propLongitude): static
    {
        $this->propLongitude = $propLongitude;

        return $this;
    }

    public function getPropSlug(): ?string
    {
        return $this->propSlug;
    }

    public function setPropSlug(string $propSlug): static
    {
        $this->propSlug = $propSlug;

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPropPicture(): Collection
    {
        return $this->propPicture;
    }

    public function addPropPicture(Picture $propPicture): static
    {
        if (!$this->propPicture->contains($propPicture)) {
            $this->propPicture->add($propPicture);
            $propPicture->setPicProperty($this);
        }

        return $this;
    }

    public function removePropPicture(Picture $propPicture): static
    {
        if ($this->propPicture->removeElement($propPicture)) {
            // set the owning side to null (unless already changed)
            if ($propPicture->getPicProperty() === $this) {
                $propPicture->setPicProperty(null);
            }
        }

        return $this;
    }

    public function getPropCategory(): ?Category
    {
        return $this->propCategory;
    }

    public function setPropCategory(?Category $propCategory): static
    {
        $this->propCategory = $propCategory;

        return $this;
    }

    public function getPropAmenity(): ?Amenity
    {
        return $this->propAmenity;
    }

    public function setPropAmenity(?Amenity $propAmenity): static
    {
        $this->propAmenity = $propAmenity;

        return $this;
    }

    public function getPropAddress(): ?Address
    {
        return $this->propAddress;
    }

    public function setPropAddress(?Address $propAddress): static
    {
        $this->propAddress = $propAddress;

        return $this;
    }

    /**
     * @return Collection<int, Rent>
     */
    public function getPropRent(): Collection
    {
        return $this->propRent;
    }

    public function addPropRent(Rent $propRent): static
    {
        if (!$this->propRent->contains($propRent)) {
            $this->propRent->add($propRent);
            $propRent->setRentProperty($this);
        }

        return $this;
    }

    public function removePropRent(Rent $propRent): static
    {
        if ($this->propRent->removeElement($propRent)) {
            // set the owning side to null (unless already changed)
            if ($propRent->getRentProperty() === $this) {
                $propRent->setRentProperty(null);
            }
        }

        return $this;
    }
	
/*     public function getGeocoder($geocoder): static
	{
		$config = [
			'timeout' => 2.0,
			'verify' => false,
		];
		$url = 'https://photon.komoot.io/api/?q=berlin';
		
		$client = new Client($config);
		$geocoder = new Photon($client, $url);

		$geocoder->geocodeQuery(GeocodeQuery::create('Berlin'));

		//$result = $geocoder->geocodeQuery(GeocodeQuery::create('Buckingham Palace, London'));
		//$result = $geocoder->reverseQuery(ReverseQuery::fromCoordinates(...));	
	} */

public function getGeocoder(): ?object
{
    return $this->geocoder;
}

public function setGeocoder(?object $geocoder): static
{
    $this->geocoder = $geocoder;

    return $this;
}
}
