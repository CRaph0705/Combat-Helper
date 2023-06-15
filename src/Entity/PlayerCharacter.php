<?php

namespace App\Entity;

use App\Repository\PlayerCharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?int $hp = null;

    #[ORM\Column(nullable: true)]
    private ?int $ac = null;

    #[ORM\Column(nullable: true)]
    private ?int $initiative = null;

    #[ORM\Column(nullable: true)]
    private ?int $hpMax = null;

    #[ORM\ManyToMany(targetEntity: Condition::class, inversedBy: 'playerCharacters')]
    private Collection $conditions;

    #[ORM\ManyToMany(targetEntity: EncounterList::class, inversedBy: 'playerCharacters')]
    private Collection $encounterLists;

    #[ORM\ManyToMany(targetEntity: Encounter::class, mappedBy: 'players')]
    private Collection $encounters;

    public function __construct()
    {
        $this->conditions = new ArrayCollection();
        $this->encounterLists = new ArrayCollection();
        $this->encounters = new ArrayCollection();
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

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(?int $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getAc(): ?int
    {
        return $this->ac;
    }

    public function setAc(?int $ac): self
    {
        $this->ac = $ac;

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

    public function getHpMax(): ?int
    {
        return $this->hpMax;
    }

    public function setHpMax(?int $hpMax): self
    {
        $this->hpMax = $hpMax;

        return $this;
    }

    /**
     * @return Collection<int, Condition>
     */
    public function getConditions(): Collection
    {
        return $this->conditions;
    }

    public function addCondition(Condition $condition): self
    {
        if (!$this->conditions->contains($condition)) {
            $this->conditions->add($condition);
        }

        return $this;
    }

    public function removeCondition(Condition $condition): self
    {
        $this->conditions->removeElement($condition);

        return $this;
    }

    /**
     * @return Collection<int, EncounterList>
     */
    public function getEncounterLists(): Collection
    {
        return $this->encounterLists;
    }

    public function addEncounterList(EncounterList $encounterList): self
    {
        if (!$this->encounterLists->contains($encounterList)) {
            $this->encounterLists->add($encounterList);
        }

        return $this;
    }

    public function removeEncounterList(EncounterList $encounterList): self
    {
        $this->encounterLists->removeElement($encounterList);

        return $this;
    }

    /**
     * @return Collection<int, Encounter>
     */
    public function getEncounters(): Collection
    {
        return $this->encounters;
    }

    public function addEncounter(Encounter $encounter): self
    {
        if (!$this->encounters->contains($encounter)) {
            $this->encounters->add($encounter);
            $encounter->addPlayer($this);
        }

        return $this;
    }

    public function removeEncounter(Encounter $encounter): self
    {
        if ($this->encounters->removeElement($encounter)) {
            $encounter->removePlayer($this);
        }

        return $this;
    }
}
