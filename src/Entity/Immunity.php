<?php

namespace App\Entity;

use App\Repository\ImmunityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImmunityRepository::class)]
class Immunity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Monster::class, mappedBy: 'damageImmunity')]
    private Collection $immuneMonsters;

    public function __construct()
    {
        $this->immuneMonsters = new ArrayCollection();
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
            $immuneMonster->addDamageImmunity($this);
        }

        return $this;
    }

    public function removeImmuneMonster(Monster $immuneMonster): static
    {
        if ($this->immuneMonsters->removeElement($immuneMonster)) {
            $immuneMonster->removeDamageImmunity($this);
        }

        return $this;
    }
}
