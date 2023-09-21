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

        ->add('name', null, [
            'label' => false,
            'attr' => [
                'hidden' => true,
                'class' => 'form-control'
            ],
        ])


        ->add('encounterPlayerCharacters', CollectionType::class, [
            'entry_type' => EncounterPlayerCharacterType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'entry_options' => [
                'label' => false,
            ],
            'label' => false,
            'required' => true,
        ])

        ->add('encounterMonsters', CollectionType::class, [
            'entry_type' => EncounterMonsterType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'entry_options' => [
                'label' => false,
            ],
            'label' => false,
            'required' => true,
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