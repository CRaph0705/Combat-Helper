<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\MonstersApiCall;
use App\Entity\Monster;
use App\Repository\AlignmentRepository;
use App\Repository\ChallengeRepository;
use App\Repository\ExpertSkillRepository;
use App\Repository\ImmunityRepository;
use App\Repository\LanguageRepository;
use App\Repository\MonsterRepository;
use App\Repository\ProficientSkillRepository;
use App\Repository\ResistanceRepository;
use App\Repository\SavingThrowRepository;
use App\Repository\SizeRepository;
use App\Repository\StateRepository;
use App\Repository\TypeRepository;
use App\Repository\VulnerabilityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Converter\MonsterDataConverter;


#[AsCommand(
    name: 'createorupdate:monsters:command',
    description: 'Add a short description for your command',
)]
class CreateOrUpdateMonstersCommand extends Command
{

    public function __construct(
        private MonstersApiCall $monstersApiCall,
        private EntityManagerInterface $em, 
        private MonsterDataConverter $monsterDataConverter,
        
        private AlignmentRepository $alignmentRepository,
        private ChallengeRepository $challengeRepository,
        private ExpertSkillRepository $expertSkillRepository,
        private ImmunityRepository $immunityRepository,
        private LanguageRepository $languageRepository,
        private MonsterRepository $monsterRepository,
        private ProficientSkillRepository $proficientSkillRepository,
        private ResistanceRepository $resistanceRepository,
        private SavingThrowRepository $savingThrowRepository,
        private SizeRepository $sizeRepository,
        private StateRepository $stateRepository,
        private TypeRepository $typeRepository,
        private VulnerabilityRepository $vulnerabilityRepository
        )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $localAlignmentsArray = $this->getEntitiesByName($this->alignmentRepository);
        $localChallengesArray = $this->getEntitiesByName($this->challengeRepository);
        $localExpertSkillsArray = $this->getEntitiesByName($this->expertSkillRepository);
        $localImmunitiesArray = $this->getEntitiesByName($this->immunityRepository);
        $localLanguagesArray = $this->getEntitiesByName($this->languageRepository);
        $localMonstersArray = $this->getEntitiesByName($this->monsterRepository);
        $localProficientSkillsArray = $this->getEntitiesByName($this->proficientSkillRepository);
        $localResistancesArray = $this->getEntitiesByName($this->resistanceRepository);
        $localSavingThrowsArray = $this->getEntitiesByName($this->savingThrowRepository);
        $localSizesArray = $this->getEntitiesByName($this->sizeRepository);
        $localStatesArray = $this->getEntitiesByName($this->stateRepository);
        $localTypesArray = $this->getEntitiesByName($this->typeRepository);
        $localVulnerabilitiesArray = $this->getEntitiesByName($this->vulnerabilityRepository);


        $apiMonsters = $this->monstersApiCall->getAllMonsters();

        foreach ($apiMonsters['results'] as $monster) {
            try {
            //on cherche si le monster existe en base
            $convertedMonsterData = $this->monsterDataConverter->convert($this->monstersApiCall->getMonster($monster));
            $monsterEntity = isset($localMonstersArray[$monster['name']])? $localMonstersArray[$monster['name']] : new Monster();
            $monsterEntity->setName($convertedMonsterData['name']);
            
            
            // là on update l'entité monster avec les données de l'api
            $monsterEntity->setSize($localSizesArray[$convertedMonsterData['size']]);
            $monsterEntity->setAlignment($localAlignmentsArray[$convertedMonsterData['alignment']]);
            $monsterEntity->setAc($convertedMonsterData['armor_class'][0]['value']);
            $monsterEntity->setHp($convertedMonsterData['hit_points']);
            if (isset($convertedMonsterData['groundspeed'])) {
                $monsterEntity->setGroundspeed($convertedMonsterData['groundspeed']);
            }
            if (isset($convertedMonsterData['flyspeed'])) {
                $monsterEntity->setFlyspeed($convertedMonsterData['flyspeed']);
            }
            if (isset($convertedMonsterData['swimspeed'])) {
                $monsterEntity->setSwimspeed($convertedMonsterData['swimspeed']);
            }
            if (isset($convertedMonsterData['burrowspeed'])) {
                $monsterEntity->setBurrowspeed($convertedMonsterData['burrowspeed']);
            }
            if (isset($convertedMonsterData['climbspeed'])) {
                $monsterEntity->setClimbspeed($convertedMonsterData['climbspeed']);
            }

            $monsterEntity->setStrength($convertedMonsterData['strength']);
            $monsterEntity->setDexterity($convertedMonsterData['dexterity']);
            $monsterEntity->setConstitution($convertedMonsterData['constitution']);
            $monsterEntity->setIntelligence($convertedMonsterData['intelligence']);
            $monsterEntity->setWisdom($convertedMonsterData['wisdom']);
            $monsterEntity->setCharisma($convertedMonsterData['charisma']);
            $monsterEntity->setType($localTypesArray[$convertedMonsterData['type']]);
            $monsterEntity->setChallenge($localChallengesArray[$convertedMonsterData['challenge']]);
            $monsterEntity->setProficiencyBonus($convertedMonsterData['proficiency_bonus']);

            if (isset($convertedMonsterData['senses']['darkvision'])) {
                $monsterEntity->setDarkvision($convertedMonsterData['senses']['darkvision']);
            }

            if (isset($convertedMonsterData['senses']['blindsight'])) {
                $monsterEntity->setBlindsight($convertedMonsterData['senses']['blindsight']);
            }

            if (isset($convertedMonsterData['senses']['tremorsense'])) {
                $monsterEntity->setTremorsense($convertedMonsterData['senses']['tremorsense']);
            }

            if (isset($convertedMonsterData['senses']['truesight'])) {
                $monsterEntity->setTruesight($convertedMonsterData['senses']['truesight']);
            }
            
            if (isset($convertedMonsterData['languages'])) {
                foreach ($convertedMonsterData['languages'] as $language) {
                    $monsterEntity->addLanguage($localLanguagesArray[$language]);
                }                
            }

            if (isset($convertedMonsterData['telepathy'])) {
                $monsterEntity->setTelepathy($convertedMonsterData['telepathy']);
            }

            if (isset($convertedMonsterData['special_abilities'])) {
                $monsterEntity->setSpecialAbilities($convertedMonsterData['special_abilities']);
            }  

            if (isset($convertedMonsterData['actions'])) {
                $monsterEntity->setActions($convertedMonsterData['actions']);
            }
            
            if (isset($convertedMonsterData['legendary_actions'])) {
                $monsterEntity->setLegendaryActions($convertedMonsterData['legendary_actions']);
            }


            ///// TODO : TO UPDATE IN CONVERTER WHEN AN IMPORT CONTAINS THESE FIELDS
            if (isset($convertedMonsterData['reactions'])) {
                $monsterEntity->setReactions($convertedMonsterData['reactions']);
            }
            
            //if damage vulnerabilities is present, set damage vulnerabilities
            if (isset($convertedMonsterData['damage_vulnerabilities'])) {
                foreach ($convertedMonsterData['damage_vulnerabilities'] as $vulnerability) {
                    $monsterEntity->addDamageVulnerability($localVulnerabilitiesArray[$vulnerability]);
                }
            }

            //if damage resistances is present, set damage resistances
            if (isset($convertedMonsterData['damage_resistances'])) {
                // if (!empty($convertedMonsterData['damage_resistances'])) {
                //     dump($convertedMonsterData['damage_resistances']);
                // }
                foreach ($convertedMonsterData['damage_resistances'] as $resistance) {
                    $monsterEntity->addDamageResistance($localResistancesArray[$resistance]);
                }
            }

            //if damage immunities is present, set damage immunities
            if (isset($convertedMonsterData['damage_immunities'])) {
                // if (!empty($convertedMonsterData['damage_immunities'])) {
                //     dump($convertedMonsterData['damage_immunities']);
                // }
                foreach ($convertedMonsterData['damage_immunities'] as $immunity) {
                    $monsterEntity->addDamageImmunity($localImmunitiesArray[$immunity]);
                }
            }

            // if proficient skills is present, set proficient skills
            if (isset($convertedMonsterData['proficient_skills'])) {
                foreach ($convertedMonsterData['proficient_skills'] as $proficientSkill) {
                    $monsterEntity->addProficientSkill($localProficientSkillsArray[$proficientSkill]);
                }
            }

            // if expert skills is present, set expert skills
            if (isset($convertedMonsterData['expert_skills'])) {
                foreach ($convertedMonsterData['expert_skills'] as $expertSkill) {
                    $monsterEntity->addExpertSkill($localExpertSkillsArray[$expertSkill]);
                }
            }


            // if saving throws is present, set saving throws
            if (isset($convertedMonsterData['saving_throws'])) {
                foreach ($convertedMonsterData['saving_throws'] as $savingThrow) {
                    $monsterEntity->addSavingThrow($localSavingThrowsArray[$savingThrow]);
                }
            }

            // if states is present, set states (immunities)
            if (isset($convertedMonsterData['condition_immunities'])) {
                foreach ($convertedMonsterData['condition_immunities'] as $state) {
                    $monsterEntity->addStateImmunity($localStatesArray[$state]);
                }
            }




            $this->em->persist($monsterEntity);
            // break;
            } catch (\Exception $e) {
                dump($e);
                dump($monster);
                dump($convertedMonsterData);
                die();
            }
        }
        $this->em->flush();
        return Command::SUCCESS;


    }

    private function getEntitiesByName($repository) {
        $entities = $repository->findAll();
        $entitiesByName = [];
        foreach ($entities as $entity) {
            $entitiesByName[$entity->getName()] = $entity;
        }
        return $entitiesByName;
    }
    

     
}
