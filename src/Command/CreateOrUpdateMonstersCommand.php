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
    name: 'CreateOrUpdateMonstersCommand',
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
            //on cherche si le monster existe en base
            $convertedMonsterData = $this->monsterDataConverter->convert($this->monstersApiCall->getMonster($monster));
            $monsterEntity = isset($localMonstersArray[$monster['name']])? $localMonstersArray[$monster['name']] : [];

            if (!$monsterEntity) {
                $monsterEntity = new Monster();
                $monsterEntity->setName($monster['name']);
            }
            // là on update l'entité monster avec les données de l'api
            // dd($localSizesArray);
            $monsterEntity->setSize($localSizesArray[$convertedMonsterData['size']]);
            $monsterEntity->setAlignment($localAlignmentsArray[$convertedMonsterData['alignment']]);
            // dd($convertedMonsterData);
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


            $this->em->persist($monsterEntity);
            break;
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
