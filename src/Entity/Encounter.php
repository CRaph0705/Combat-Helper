<?php

namespace App\Entity;

use App\Repository\EncounterListRepository;
use App\Repository\EncounterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EncounterRepository::class)]
class Encounter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    private int $round = 0;
    
    //array of units
    private array $units = [];

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'encounter', targetEntity: EncounterMonster::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $encounterMonsters;

    #[ORM\OneToMany(mappedBy: 'encounter', targetEntity: EncounterPlayerCharacter::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $encounterPlayerCharacters;


    public function __construct()
    {
        $this->encounterMonsters = new ArrayCollection();
        $this->encounterPlayerCharacters = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getName() ?? 'Encounter';
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    //on créé une fonction pour trier les unités par initiative
    public function sortUnitsByInitiative($units){
        usort($units, function ($a, $b) {
            return $b->getInitiative() <=> $a->getInitiative();
        });
    }

    public function getRound(): int
    {
        return $this->round;
    }

    public function setRound(int $round): self
    {
        $this->round = $round;

        return $this;
    }
############################################################################################################
    // ENCOUNTER INITIALIZATION FUNCTIONS
    // UNITS FUNCTIONS
    public function getUnits(): array
    {
        return $this->units;
    }

    public function setUnits(array $units): self
    {
        $this->units = $units;

        return $this;
    }

    public function addUnit($unit): self
    {
        if (!in_array($unit, $this->units)) {
            $this->units[] = $unit;
        }

        return $this;
    }

    public function removeUnit($unit): self
    {
        $this->units = array_diff($this->units, [$unit]);

        return $this;
    }

    public function clearUnits(): self
    {
        $this->units = [];

        return $this;
    }

############################################################################################################
    //ENCOUNTER FUNCTIONS
    public function startEncounter(): self
    {
        //TODO
        return $this;
    }

    public function endEncounter(): self
    {
        //TODO
        return $this;
    }

    public function resetEncounter(): self
    {
        //TODO
        return $this;
    }

    public function saveEncounterToDatabase(): self
    {
        //TODO
        return $this;
    }

    public function loadEncounter(): self
    {
        //TODO
        return $this;
    }

    public function nextRound(): self
    {
        //TODO
        return $this;
    }

    public function nextTurn(): self
    {
        //TODO
        return $this;
    }

    public function previousRound(): self
    {
        //TODO
        return $this;
    }

    public function previousTurn(): self
    {
        //TODO
        return $this;
    }

    public function addUnitToEncounter($unit): self
    {
        //TODO
        return $this;
    }

    public function removeUnitFromEncounter($unit): self
    {
        //TODO
        return $this;
    }

    public function clearEncounter(): self
    {
        //TODO
        return $this;
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

    /**
     * @return Collection<int, EncounterMonster>
     */
    public function getEncounterMonsters(): Collection
    {
        return $this->encounterMonsters;
    }

    public function addEncounterMonster(EncounterMonster $encounterMonster): self
    {
        if (!$this->encounterMonsters->contains($encounterMonster)) {
            $this->encounterMonsters->add($encounterMonster);
            $encounterMonster->setEncounter($this);
        }

        return $this;
    }

    public function removeEncounterMonster(EncounterMonster $encounterMonster): self
    {
        if ($this->encounterMonsters->removeElement($encounterMonster)) {
            // set the owning side to null (unless already changed)
            if ($encounterMonster->getEncounter() === $this) {
                $encounterMonster->setEncounter(null);
            }
        }

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
            $encounterPlayerCharacter->setEncounter($this);
        }

        return $this;
    }

    public function removeEncounterPlayerCharacter(EncounterPlayerCharacter $encounterPlayerCharacter): self
    {
        if ($this->encounterPlayerCharacters->removeElement($encounterPlayerCharacter)) {
            // set the owning side to null (unless already changed)
            if ($encounterPlayerCharacter->getEncounter() === $this) {
                $encounterPlayerCharacter->setEncounter(null);
            }
        }

        return $this;
    }

}
