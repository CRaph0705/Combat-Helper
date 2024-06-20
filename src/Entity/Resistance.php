<?php

namespace App\Entity;

use App\Repository\ResistanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResistanceRepository::class)]
class Resistance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Monster::class, mappedBy: 'resistance')]
    private Collection $resistantMonsters;

    public function __construct()
    {
        $this->resistantMonsters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Monster>
     */
    public function getResistantMonsters(): Collection
    {
        return $this->resistantMonsters;
    }

    public function addResistantMonster(Monster $resistantMonster): static
    {
        if (!$this->resistantMonsters->contains($resistantMonster)) {
            $this->resistantMonsters->add($resistantMonster);
            $resistantMonster->addResistance($this);
        }

        return $this;
    }

    public function removeResistantMonster(Monster $resistantMonster): static
    {
        if ($this->resistantMonsters->removeElement($resistantMonster)) {
            $resistantMonster->removeResistance($this);
        }

        return $this;
    }
}
