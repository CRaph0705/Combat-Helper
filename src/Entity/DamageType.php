<?php

namespace App\Entity;

use App\Repository\DamageTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DamageTypeRepository::class)]
class DamageType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Monster::class, mappedBy: 'damageTypeImmunity')]
    private Collection $immuneMonsters;

    public function __construct()
    {
        $this->immuneMonsters = new ArrayCollection();
        $this->vulnerableMonsters = new ArrayCollection();
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
    public function getImmuneMonsters(): Collection
    {
        return $this->immuneMonsters;
    }

    public function addImmuneMonster(Monster $immuneMonster): static
    {
        if (!$this->immuneMonsters->contains($immuneMonster)) {
            $this->immuneMonsters->add($immuneMonster);
            $immuneMonster->addDamageTypeImmunity($this);
        }

        return $this;
    }

    public function removeImmuneMonster(Monster $immuneMonster): static
    {
        if ($this->immuneMonsters->removeElement($immuneMonster)) {
            $immuneMonster->removeDamageTypeImmunity($this);
        }

        return $this;
    }

}
