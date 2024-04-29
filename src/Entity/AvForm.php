<?php

namespace App\Entity;

use App\Repository\AvFormRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvFormRepository::class)]
class AvForm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $message_form = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvTravel $AvTravel = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvStatus $AvStatus = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvUser $AvUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessageForm(): ?string
    {
        return $this->message_form;
    }

    public function setMessageForm(string $message_form): static
    {
        $this->message_form = $message_form;

        return $this;
    }

    public function getAvTravel(): ?AvTravel
    {
        return $this->AvTravel;
    }

    public function setAvTravel(?AvTravel $AvTravel): static
    {
        $this->AvTravel = $AvTravel;

        return $this;
    }

    public function getAvStatus(): ?AvStatus
    {
        return $this->AvStatus;
    }

    public function setAvStatus(?AvStatus $AvStatus): static
    {
        $this->AvStatus = $AvStatus;

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
}
