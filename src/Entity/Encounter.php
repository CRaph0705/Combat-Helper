<?php

namespace App\Entity;

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

    #[ORM\ManyToMany(targetEntity: PlayerCharacter::class, inversedBy: 'encounters')]
    private Collection $players;

    #[ORM\ManyToMany(targetEntity: Monster::class, inversedBy: 'encounters')]
    private Collection $monsters;


    private int $round = 0;
    
    //array of units
    private array $units = [];


    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->monsters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, PlayerCharacter>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(PlayerCharacter $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
        }

        return $this;
    }

    public function removePlayer(PlayerCharacter $player): self
    {
        $this->players->removeElement($player);

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
        }

        return $this;
    }

    public function removeMonster(Monster $monster): self
    {
        $this->monsters->removeElement($monster);

        return $this;
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

    public function saveUnits(): self
    {
        //TODO
        return $this;
    }

    public function loadUnits(): self
    {
        //TODO
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

}
