<?php

namespace App\Entity;

use App\Repository\MonsterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

    // #[ORM\Column(length: 10, nullable: true)]
    #[ORM\ManyToOne(targetEntity: Challenge::class)]
    private ?Challenge $challenge = null;

    #[ORM\Column(nullable: true)]
    private ?float $groundspeed = null;

    #[ORM\Column(nullable: true)]
    private ?float $climbspeed = null;

    #[ORM\Column(nullable: true)]
    private ?float $flyspeed = null;

    #[ORM\Column(nullable: true)]
    private ?float $burrowspeed = null;

    #[ORM\Column(nullable: true)]
    private ?float $swimspeed = null;

    #[ORM\ManyToOne(inversedBy: 'monsters')]
    private ?Size $size = null;

    #[ORM\ManyToOne(inversedBy: 'monsters')]
    private ?Type $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtype = null;

    #[ORM\ManyToOne(inversedBy: 'monsters')]
    private ?Alignment $alignment = null;

    #[ORM\Column(nullable: true)]
    private ?float $tremorsense = null;

    #[ORM\Column(nullable: true)]
    private ?float $blindsight = null;

    #[ORM\Column(nullable: true)]
    private ?float $darkvision = null;

    #[ORM\Column(nullable: true)]
    private ?float $truesight = null;

    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'monsters', cascade: ['persist'])]
    private Collection $languages;

    #[ORM\Column(nullable: true)]
    private ?float $telepathy = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customLanguage = null;

    #[ORM\ManyToMany(targetEntity: State::class, inversedBy: 'monsters')]
    private Collection $stateImmunity;

    #[ORM\ManyToMany(targetEntity: Vulnerability::class, inversedBy: 'vulnerableMonsters')]
    private Collection $damageVulnerability;

    #[ORM\ManyToMany(targetEntity: Immunity::class, inversedBy: 'immuneMonsters')]
    private Collection $damageImmunity;

    #[ORM\ManyToMany(targetEntity: Resistance::class, inversedBy: 'resistantMonsters')]
    private Collection $damageResistance;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $specialAbilities = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $actions = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $legendaryActions = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $reactions = null;

    #[ORM\ManyToMany(targetEntity: ProficientSkill::class, inversedBy: 'monsters')]
    private Collection $proficientSkill;

    #[ORM\ManyToMany(targetEntity: ExpertSkill::class, inversedBy: 'monsters')]
    private Collection $expertSkill;

    #[ORM\Column(nullable: true)]
    private ?int $proficiencyBonus = null;

    #[ORM\ManyToMany(targetEntity: SavingThrow::class, inversedBy: 'monsters')]
    private Collection $savingThrows;

    public function __construct()
    {
        $this->languages = new ArrayCollection();
        $this->stateImmunity = new ArrayCollection();
        $this->damageTypeImmunity = new ArrayCollection();
        $this->damageTypeVulnerability = new ArrayCollection();
        $this->damageResistance = new ArrayCollection();
        $this->damageVulnerability = new ArrayCollection();
        $this->damageImmunity = new ArrayCollection();
        $this->proficientSkill = new ArrayCollection();
        $this->expertSkill = new ArrayCollection();
        $this->savingThrows = new ArrayCollection();
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

    public function getChallenge(): ?Challenge
    {
        return $this->challenge;
    }

    public function setChallenge(?Challenge $challenge): self
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

    public function getGroundspeed(): ?float
    {
        return $this->groundspeed;
    }

    public function setGroundspeed(?float $groundspeed): static
    {
        $this->groundspeed = $groundspeed;

        return $this;
    }

    public function getClimbspeed(): ?float
    {
        return $this->climbspeed;
    }

    public function setClimbspeed(?float $climbspeed): static
    {
        $this->climbspeed = $climbspeed;

        return $this;
    }

    public function getFlyspeed(): ?float
    {
        return $this->flyspeed;
    }

    public function setFlyspeed(?float $flyspeed): static
    {
        $this->flyspeed = $flyspeed;

        return $this;
    }

    public function getBurrowspeed(): ?float
    {
        return $this->burrowspeed;
    }

    public function setBurrowspeed(?float $burrowspeed): static
    {
        $this->burrowspeed = $burrowspeed;

        return $this;
    }

    public function getSwimspeed(): ?float
    {
        return $this->swimspeed;
    }

    public function setSwimspeed(?float $swimspeed): static
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

    /**
     * @return Collection<int, Language>
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Language $language): static
    {
        if (!$this->languages->contains($language)) {
            $this->languages->add($language);
        }

        return $this;
    }

    public function removeLanguage(Language $language): static
    {
        $this->languages->removeElement($language);

        return $this;
    }

    public function getTelepathy(): ?int
    {
        return $this->telepathy;
    }

    public function setTelepathy(?int $telepathy): static
    {
        $this->telepathy = $telepathy;

        return $this;
    }

    public function getCustomLanguage(): ?string
    {
        return $this->customLanguage;
    }

    public function setCustomLanguage(?string $customLanguage): static
    {
        $this->customLanguage = $customLanguage;

        return $this;
    }

    /**
     * @return Collection<int, State>
     */
    public function getStateImmunity(): Collection
    {
        return $this->stateImmunity;
    }

    public function addStateImmunity(State $stateImmunity): static
    {
        if (!$this->stateImmunity->contains($stateImmunity)) {
            $this->stateImmunity->add($stateImmunity);
        }

        return $this;
    }

    public function removeStateImmunity(State $stateImmunity): static
    {
        $this->stateImmunity->removeElement($stateImmunity);

        return $this;
    }

    /**
     * @return Collection<int, Vulnerability>
     */
    public function getDamageVulnerability(): Collection
    {
        return $this->damageVulnerability;
    }

    public function addDamageVulnerability(Vulnerability $damageVulnerability): static
    {
        if (!$this->damageVulnerability->contains($damageVulnerability)) {
            $this->damageVulnerability->add($damageVulnerability);
        }

        return $this;
    }

    public function removeDamageVulnerability(Vulnerability $damageVulnerability): static
    {
        $this->damageVulnerability->removeElement($damageVulnerability);

        return $this;
    }

    /**
     * @return Collection<int, Immunity>
     */
    public function getDamageImmunity(): Collection
    {
        return $this->damageImmunity;
    }

    public function addDamageImmunity(Immunity $damageImmunity): static
    {
        if (!$this->damageImmunity->contains($damageImmunity)) {
            $this->damageImmunity->add($damageImmunity);
        }

        return $this;
    }

    public function removeDamageImmunity(Immunity $damageImmunity): static
    {
        $this->damageImmunity->removeElement($damageImmunity);

        return $this;
    }

    /**
     * @return Collection<int, Resistance>
     */
    public function getDamageResistance(): Collection
    {
        return $this->damageResistance;
    }

    public function addDamageResistance(Resistance $damageResistance): static
    {
        if (!$this->damageResistance->contains($damageResistance)) {
            $this->damageResistance->add($damageResistance);
        }

        return $this;
    }

    public function removeDamageResistance(Resistance $damageResistance): static
    {
        $this->damageResistance->removeElement($damageResistance);

        return $this;
    }

    public function getSpecialAbilities(): ?string
    {
        return $this->specialAbilities;
    }

    public function setSpecialAbilities(?string $specialAbilities): static
    {
        $this->specialAbilities = $specialAbilities;

        return $this;
    }

    public function getActions(): ?string
    {
        return $this->actions;
    }

    public function setActions(?string $actions): static
    {
        $this->actions = $actions;

        return $this;
    }

    public function getLegendaryActions(): ?string
    {
        return $this->legendaryActions;
    }

    public function setLegendaryActions(?string $legendaryActions): static
    {
        $this->legendaryActions = $legendaryActions;

        return $this;
    }

    public function getReactions(): ?string
    {
        return $this->reactions;
    }

    public function setReactions(?string $reactions): static
    {
        $this->reactions = $reactions;

        return $this;
    }

    public function getSpeed(): string
    {
        $speed = '';

        $this->getGroundspeed();
        $this->getClimbspeed();
        $this->getFlyspeed();
        $this->getBurrowspeed();
        $this->getSwimspeed();
        
        $speed .= $this->groundspeed ? ' '.$this->groundspeed.'m' : '0m';
        $speed .= $this->climbspeed ? ', escalade '.$this->climbspeed.'m' : '';
        $speed .= $this->flyspeed ? ', vol '.$this->flyspeed.'m' : '';
        $speed .= $this->burrowspeed ? ', fouissement '.$this->burrowspeed.'m' : '';
        $speed .= $this->swimspeed ? ', nage '.$this->swimspeed.'m' : '';

        
        return $speed;
    }

    public function getStatModulo(int $value): string
    {
        $moduloValue = floor(($value - 10) / 2);
        $modulo = $value < 10 ? '('.$moduloValue .')' : '(+' .$moduloValue .')';

        return $modulo;
    }

    /**
     * @return Collection<int, ProficientSkill>
     */
    public function getProficientSkill(): Collection
    {
        return $this->proficientSkill;
    }

    public function addProficientSkill(ProficientSkill $proficientSkill): static
    {
        if (!$this->proficientSkill->contains($proficientSkill)) {
            $this->proficientSkill->add($proficientSkill);
        }

        return $this;
    }

    public function removeProficientSkill(ProficientSkill $proficientSkill): static
    {
        $this->proficientSkill->removeElement($proficientSkill);

        return $this;
    }

    /**
     * @return Collection<int, ExpertSkill>
     */
    public function getExpertSkill(): Collection
    {
        return $this->expertSkill;
    }

    public function addExpertSkill(ExpertSkill $expertSkill): static
    {
        if (!$this->expertSkill->contains($expertSkill)) {
            $this->expertSkill->add($expertSkill);
        }

        return $this;
    }

    public function removeExpertSkill(ExpertSkill $expertSkill): static
    {
        $this->expertSkill->removeElement($expertSkill);

        return $this;
    }

    public function getProficiencyBonus(): ?int
    {
        return $this->proficiencyBonus;
    }

    public function setProficiencyBonus(?int $proficiencyBonus): static
    {
        $this->proficiencyBonus = $proficiencyBonus;

        return $this;
    }

    /**
     * @return Collection<int, SavingThrow>
     */
    public function getSavingThrows(): Collection
    {
        return $this->savingThrows;
    }

    public function addSavingThrow(SavingThrow $savingThrow): static
    {
        if (!$this->savingThrows->contains($savingThrow)) {
            $this->savingThrows->add($savingThrow);
        }

        return $this;
    }

    public function removeSavingThrow(SavingThrow $savingThrow): static
    {
        $this->savingThrows->removeElement($savingThrow);

        return $this;
    }

    // perception passive (Sagesse) est égale à 10 + modificateur de Sagesse + bonus de maîtrise (si la compétence Perception est maîtrisée)
    public function getPassivePerception(): int
    {
        $wisdomModuloString = $this->getStatModulo($this->getWisdom());
        $wisdomModulo = (int)str_replace(['(', ')', '+'], '', $wisdomModuloString);
        $passivePerception = 10 + $wisdomModulo;

        if ($this->getProficientSkill()->contains('Perception')) {
            $passivePerception += $this->getProficiencyBonus();
        }


        return $passivePerception;
    }
}
