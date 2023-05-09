<?php

namespace App\Entity;

use App\Repository\PlayerCharacterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerCharacterRepository::class)]
class PlayerCharacter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $AC = null;

    #[ORM\Column(nullable: true)]
    private ?int $HP = null;

    #[ORM\Column(nullable: true)]
    private ?int $initiative = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAC(): ?int
    {
        return $this->AC;
    }

    public function setAC(?int $AC): self
    {
        $this->AC = $AC;

        return $this;
    }

    public function getHP(): ?int
    {
        return $this->HP;
    }

    public function setHP(?int $HP): self
    {
        $this->HP = $HP;

        return $this;
    }

    public function getInitiative(): ?int
    {
        return $this->initiative;
    }

    public function setInitiative(?int $initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }
}
