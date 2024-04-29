<?php

namespace App\Entity;

use App\Repository\AvCountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvCountryRepository::class)]
class AvCountry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_country = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCountry(): ?string
    {
        return $this->name_country;
    }

    public function setNameCountry(string $name_country): static
    {
        $this->name_country = $name_country;

        return $this;
    }
}
