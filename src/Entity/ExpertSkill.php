<?php

namespace App\Entity;

use App\Repository\ExpertSkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpertSkillRepository::class)]
class ExpertSkill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Monster::class, mappedBy: 'expertSkill')]
    private Collection $monsters;

    public function __construct()
    {
        $this->monsters = new ArrayCollection();
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
    public function getMonsters(): Collection
    {
        return $this->monsters;
    }

    public function addMonster(Monster $monster): static
    {
        if (!$this->monsters->contains($monster)) {
            $this->monsters->add($monster);
            $monster->addExpertSkill($this);
        }

        return $this;
    }

    public function removeMonster(Monster $monster): static
    {
        if ($this->monsters->removeElement($monster)) {
            $monster->removeExpertSkill($this);
        }

        return $this;
    }
}
