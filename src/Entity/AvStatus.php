<?php

namespace App\Entity;

use App\Repository\AvStatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvStatusRepository::class)]
class AvStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameStatus(): ?string
    {
        return $this->name_status;
    }

    public function setNameStatus(string $name_status): static
    {
        $this->name_status = $name_status;

        return $this;
    }
}
