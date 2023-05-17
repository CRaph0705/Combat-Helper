<?php

namespace App\Entity;

use App\Repository\EncounterListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EncounterListRepository::class)]
class EncounterList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $isPcList = null;

    #[ORM\ManyToMany(targetEntity: Monster::class, mappedBy: 'encounterLists')]
    private Collection $monsters;

    #[ORM\ManyToMany(targetEntity: PlayerCharacter::class, mappedBy: 'encounterLists')]
    private Collection $playerCharacters;

    public function __construct()
    {
        $this->monsters = new ArrayCollection();
        $this->playerCharacters = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

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

    public function isIsPcList(): ?bool
    {
        return $this->isPcList;
    }

    public function setIsPcList(bool $isPcList): self
    {
        $this->isPcList = $isPcList;

        return $this;
    }

    /**
     * @return Collection<int, Monster>
     */
    public function getMonsters(): Collection
    {
        return $this->monsters;
    }

    public function addMonster(Monster $monster): self
    {
        if (!$this->monsters->contains($monster)) {
            $this->monsters->add($monster);
            $monster->addEncounterList($this);
        }

        return $this;
    }

    public function removeMonster(Monster $monster): self
    {
        if ($this->monsters->removeElement($monster)) {
            $monster->removeEncounterList($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, PlayerCharacter>
     */
    public function getPlayerCharacters(): Collection
    {
        return $this->playerCharacters;
    }

    public function addPlayerCharacter(PlayerCharacter $playerCharacter): self
    {
        if (!$this->playerCharacters->contains($playerCharacter)) {
            $this->playerCharacters->add($playerCharacter);
            $playerCharacter->addEncounterList($this);
        }

        return $this;
    }

    public function removePlayerCharacter(PlayerCharacter $playerCharacter): self
    {
        if ($this->playerCharacters->removeElement($playerCharacter)) {
            $playerCharacter->removeEncounterList($this);
        }

        return $this;
    }
}
