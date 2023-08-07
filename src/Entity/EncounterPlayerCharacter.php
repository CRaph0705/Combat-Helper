<?php

namespace App\Entity;

use App\Repository\EncounterPlayerCharacterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EncounterPlayerCharacterRepository::class)]
class EncounterPlayerCharacter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'encounterPlayerCharacters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Encounter $encounter = null;

    #[ORM\ManyToOne(inversedBy: 'encounterPlayerCharacters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PlayerCharacter $playerCharacter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEncounter(): ?Encounter
    {
        return $this->encounter;
    }

    public function setEncounter(?Encounter $encounter): self
    {
        $this->encounter = $encounter;

        return $this;
    }

    public function getPlayerCharacter(): ?PlayerCharacter
    {
        return $this->playerCharacter;
    }

    public function setPlayerCharacter(?PlayerCharacter $playerCharacter): self
    {
        $this->playerCharacter = $playerCharacter;

        return $this;
    }
}
