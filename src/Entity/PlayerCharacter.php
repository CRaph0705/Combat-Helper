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

    #[ORM\OneToMany(mappedBy: 'playerCharacter', targetEntity: EncounterPlayerCharacter::class, orphanRemoval: true)]
    private Collection $encounterPlayerCharacters;

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

}
