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
}
