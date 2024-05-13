<?php

namespace App\Entity;

use App\Repository\AvTravelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AvTravelRepository::class)]
class AvTravel
{
    #[ORM\Id]
    #[Groups([
        'api_av_travel_index'
    ])]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups([
        'api_av_travel_index'
    ])]
    private ?string $title_travel = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups([
        'api_av_travel_index'
    ])]
    private ?string $picture_travel = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups([
        'api_av_travel_index'
    ])]
    private ?string $description_travel = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups([
        'api_av_travel_index'
    ])]
    private ?\DateTimeInterface $datestart_travel = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups([
        'api_av_travel_index'
    ])]
    private ?\DateTimeInterface $dateend_travel = null;

    #[ORM\Column]
    #[Groups([
        'api_av_travel_index'
    ])]
    private ?int $price_travel = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvUser $AvUser = null;

    /**
     * @var Collection<int, AvCategory>
     */
    #[ORM\ManyToMany(targetEntity: AvCategory::class)]
    #[Groups([
        'api_av_travel_index'
    ])]
    private Collection $AvCategory;

    /**
     * @var Collection<int, AvCountry>
     */
    #[ORM\ManyToMany(targetEntity: AvCountry::class)]
    
    private Collection $AvCountry;

    public function __construct()
    {
        $this->AvCategory = new ArrayCollection();
        $this->AvCountry = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleTravel(): ?string
    {
        return $this->title_travel;
    }

    public function setTitleTravel(string $title_travel): static
    {
        $this->title_travel = $title_travel;

        return $this;
    }

    public function getPictureTravel(): ?string
    {
        return $this->picture_travel;
    }

    public function setPictureTravel(?string $picture_travel): static
    {
        $this->picture_travel = $picture_travel;

        return $this;
    }

    public function getDescriptionTravel(): ?string
    {
        return $this->description_travel;
    }

    public function setDescriptionTravel(string $description_travel): static
    {
        $this->description_travel = $description_travel;

        return $this;
    }

    public function getDatestartTravel(): ?\DateTimeInterface
    {
        return $this->datestart_travel;
    }

    public function setDatestartTravel(\DateTimeInterface $datestart_travel): static
    {
        $this->datestart_travel = $datestart_travel;

        return $this;
    }

    public function getDateendTravel(): ?\DateTimeInterface
    {
        return $this->dateend_travel;
    }

    public function setDateendTravel(\DateTimeInterface $dateend_travel): static
    {
        $this->dateend_travel = $dateend_travel;

        return $this;
    }

    public function getPriceTravel(): ?int
    {
        return $this->price_travel;
    }

    public function setPriceTravel(int $price_travel): static
    {
        $this->price_travel = $price_travel;

        return $this;
    }

    public function getAvUser(): ?AvUser
    {
        return $this->AvUser;
    }

    public function setAvUser(?AvUser $AvUser): static
    {
        $this->AvUser = $AvUser;

        return $this;
    }

    /**
     * @return Collection<int, AvCategory>
     */
    public function getAvCategory(): Collection
    {
        return $this->AvCategory;
    }

    public function addAvCategory(AvCategory $avCategory): static
    {
        if (!$this->AvCategory->contains($avCategory)) {
            $this->AvCategory->add($avCategory);
        }

        return $this;
    }

    public function removeAvCategory(AvCategory $avCategory): static
    {
        $this->AvCategory->removeElement($avCategory);

        return $this;
    }

    /**
     * @return Collection<int, AvCountry>
     */
    public function getAvCountry(): Collection
    {
        return $this->AvCountry;
    }

    public function addAvCountry(AvCountry $avCountry): static
    {
        if (!$this->AvCountry->contains($avCountry)) {
            $this->AvCountry->add($avCountry);
        }

        return $this;
    }

    public function removeAvCountry(AvCountry $avCountry): static
    {
        $this->AvCountry->removeElement($avCountry);

        return $this;
    }
}
