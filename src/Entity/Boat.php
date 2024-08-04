<?php

namespace App\Entity;

use App\Repository\BoatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\component\validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BoatRepository::class)]
class Boat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $title = null;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;
    
    #[ORM\Column(length: 100)]
    private ?string $boatType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $brand = null;

    #[Assert\Range(min: 1, max: 20)]
    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $numberOfPlaces = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $material = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string')]
    private ?string $pictureFilename = null;

    #[ORM\ManyToOne(inversedBy: 'fk_boat_user')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $fk_boat_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getBoatType(): ?string
    {
        return $this->boatType;
    }

    public function setBoatType(string $boatType): static
    {
        $this->boatType = $boatType;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getNumberOfPlaces(): ?int
    {
        return $this->numberOfPlaces;
    }

    public function setNumberOfPlaces(int $numberOfPlaces): static
    {
        $this->numberOfPlaces = $numberOfPlaces;

        return $this;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(?string $material): static
    {
        $this->material = $material;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPictureFilename(): string {
        
        if (!$this->pictureFilename) return null;
        
        else if (strpos($this->pictureFilename, '/') != false) {
            return $this->pictureFilename;
        }
        return sprintf('uploads/pictures/%s', $this->pictureFilename);
    }

    public function setPictureFilename(string $newPictureFilename): self {
        
        $this->pictureFilename = $newPictureFilename;

        return $this;
    }

    public function getFKBoatUser(): ?User
    {
        return $this->fk_boat_user;
    }

    /** set an user for the ad.
     * @param 
     */
    public function setFKBoatUser(?User $fk_boat_user): static
    {
        $this->fk_boat_user = $fk_boat_user;

        return $this;
    }
}
