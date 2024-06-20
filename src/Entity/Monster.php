<?php

namespace App\Entity;

use App\Repository\MonsterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonsterRepository::class)]
class Monster
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

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $challenge = null;

    #[ORM\Column(nullable: true)]
    private ?int $groundspeed = null;

    #[ORM\Column(nullable: true)]
    private ?int $climbspeed = null;

    #[ORM\Column(nullable: true)]
    private ?int $flyspeed = null;

    #[ORM\Column(nullable: true)]
    private ?int $burrowspeed = null;

    #[ORM\Column(nullable: true)]
    private ?int $swimspeed = null;

    #[ORM\ManyToOne(inversedBy: 'monsters')]
    private ?Size $size = null;

    #[ORM\ManyToOne(inversedBy: 'monsters')]
    private ?Type $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtype = null;

    #[ORM\ManyToOne(inversedBy: 'monsters')]
    private ?Alignment $alignment = null;

    #[ORM\Column(nullable: true)]
    private ?int $tremorsense = null;

    #[ORM\Column(nullable: true)]
    private ?int $blindsight = null;

    #[ORM\Column(nullable: true)]
    private ?int $darkvision = null;

    #[ORM\Column(nullable: true)]
    private ?int $truesight = null;

    public function __construct()
    {
    }

    public function __toString(): string
    {
        return $this->name ?? '';
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

    public function getChallenge(): ?string
    {
        return $this->challenge;
    }

    public function setChallenge(?string $challenge): self
    {
        $this->challenge = $challenge;

        return $this;
    }

    public function setStats(int $strength, int $dexterity, int $constitution, int $intelligence, int $wisdom, int $charisma): self
    {
        $this->strength = $strength;
        $this->dexterity = $dexterity;
        $this->constitution = $constitution;
        $this->intelligence = $intelligence;
        $this->wisdom = $wisdom;
        $this->charisma = $charisma;

        return $this;
    }

    public function getStats(): array
    {
        return [
            'strength' => $this->strength,
            'dexterity' => $this->dexterity,
            'constitution' => $this->constitution,
            'intelligence' => $this->intelligence,
            'wisdom' => $this->wisdom,
            'charisma' => $this->charisma,
        ];
    }

    public function getGroundspeed(): ?int
    {
        return $this->groundspeed;
    }

    public function setGroundspeed(?int $groundspeed): static
    {
        $this->groundspeed = $groundspeed;

        return $this;
    }

    public function getClimbspeed(): ?int
    {
        return $this->climbspeed;
    }

    public function setClimbspeed(?int $climbspeed): static
    {
        $this->climbspeed = $climbspeed;

        return $this;
    }

    public function getFlyspeed(): ?int
    {
        return $this->flyspeed;
    }

    public function setFlyspeed(?int $flyspeed): static
    {
        $this->flyspeed = $flyspeed;

        return $this;
    }

    public function getBurrowspeed(): ?int
    {
        return $this->burrowspeed;
    }

    public function setBurrowspeed(?int $burrowspeed): static
    {
        $this->burrowspeed = $burrowspeed;

        return $this;
    }

    public function getSwimspeed(): ?int
    {
        return $this->swimspeed;
    }

    public function setSwimspeed(?int $swimspeed): static
    {
        $this->swimspeed = $swimspeed;

        return $this;
    }

    public function getSize(): ?Size
    {
        return $this->size;
    }

    public function setSize(?Size $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getSubtype(): ?string
    {
        return $this->subtype;
    }

    public function setSubtype(?string $subtype): static
    {
        $this->subtype = $subtype;

        return $this;
    }

    public function getAlignment(): ?Alignment
    {
        return $this->alignment;
    }

    public function setAlignment(?Alignment $alignment): static
    {
        $this->alignment = $alignment;

        return $this;
    }

    public function getTremorsense(): ?int
    {
        return $this->tremorsense;
    }

    public function setTremorsense(?int $tremorsense): static
    {
        $this->tremorsense = $tremorsense;

        return $this;
    }

    public function getBlindsight(): ?int
    {
        return $this->blindsight;
    }

    public function setBlindsight(?int $blindsight): static
    {
        $this->blindsight = $blindsight;

        return $this;
    }

    public function getDarkvision(): ?int
    {
        return $this->darkvision;
    }

    public function setDarkvision(?int $darkvision): static
    {
        $this->darkvision = $darkvision;

        return $this;
    }

    public function getTruesight(): ?int
    {
        return $this->truesight;
    }

    public function setTruesight(?int $truesight): static
    {
        $this->truesight = $truesight;

        return $this;
    }
}
