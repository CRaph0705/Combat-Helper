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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $speed = null;

    #[ORM\Column(nullable: true)]
    private ?int $strength = null;

    #[ORM\Column(nullable: true)]
    private ?int $dexterity = null;

    #[ORM\Column(nullable: true)]
    private ?int $constitution = null;

    #[ORM\Column(nullable: true)]
    private ?int $intelligence = null;

    #[ORM\Column(nullable: true)]
    private ?int $wisdom = null;

    #[ORM\Column(nullable: true)]
    private ?int $charisma = null;

    #[ORM\OneToMany(mappedBy: 'playerCharacter', targetEntity: EncounterPlayerCharacter::class, orphanRemoval: true)]
    private Collection $encounterPlayerCharacters;

    #[ORM\Column]
    private ?int $level = null;

    public function __construct()
    {
        $this->encounterPlayerCharacters = new ArrayCollection();
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


    public function getSpeed(): ?string
    {
        return $this->speed;
    }

    public function setSpeed(?string $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(?int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getDexterity(): ?int
    {
        return $this->dexterity;
    }

    public function setDexterity(?int $dexterity): self
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getConstitution(): ?int
    {
        return $this->constitution;
    }

    public function setConstitution(?int $constitution): self
    {
        $this->constitution = $constitution;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(?int $intelligence): self
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getWisdom(): ?int
    {
        return $this->wisdom;
    }

    public function setWisdom(?int $wisdom): self
    {
        $this->wisdom = $wisdom;

        return $this;
    }

    public function getCharisma(): ?int
    {
        return $this->charisma;
    }

    public function setCharisma(?int $charisma): self
    {
        $this->charisma = $charisma;

        return $this;
    }

    /**
     * @return Collection<int, EncounterPlayerCharacter>
     */
    public function getEncounterPlayerCharacters(): Collection
    {
        return $this->encounterPlayerCharacters;
    }

    public function addEncounterPlayerCharacter(EncounterPlayerCharacter $encounterPlayerCharacter): self
    {
        if (!$this->encounterPlayerCharacters->contains($encounterPlayerCharacter)) {
            $this->encounterPlayerCharacters->add($encounterPlayerCharacter);
            $encounterPlayerCharacter->setPlayerCharacter($this);
        }

        return $this;
    }

    public function removeEncounterPlayerCharacter(EncounterPlayerCharacter $encounterPlayerCharacter): self
    {
        if ($this->encounterPlayerCharacters->removeElement($encounterPlayerCharacter)) {
            // set the owning side to null (unless already changed)
            if ($encounterPlayerCharacter->getPlayerCharacter() === $this) {
                $encounterPlayerCharacter->setPlayerCharacter(null);
            }
        }

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

}
