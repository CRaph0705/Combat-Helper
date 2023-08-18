<?php

namespace App\Form;

use App\Entity\Encounter;
use App\Entity\EncounterMonster;
use App\Form\EncounterMonsterType;
use App\Form\EncounterPlayerCharacterType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EncounterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    $builder

        //hide name field on form
        ->add('name', null, [
            'label' => false,
            'attr' => [
                'hidden' => true,
            ],
        ])


        ->add('encounterPlayerCharacters', CollectionType::class, [
            'entry_type' => EncounterPlayerCharacterType::class,
            // 'label' => 'Player Character',
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'entry_options' => [
                'label' => false,
            ],
            'label' => false,
        ])

        ->add('encounterMonsters', CollectionType::class, [
            'entry_type' => EncounterMonsterType::class,
            // 'label' => 'Monsters',
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            //id hidden
            'entry_options' => [
                'label' => false,
            ],
            //label hidden
            'label' => false,
        ]);
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Encounter::class,
            'show_ac' => false,
            'monstersAvailable' => [],
            'added_monsters' => [],
            'current_encounter' => null,
        ]);
    }
}