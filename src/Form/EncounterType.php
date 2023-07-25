<?php

namespace App\Form;

use App\Entity\Encounter;
use App\Entity\Monster;
use App\Entity\PlayerCharacter;
use App\Form\MonsterType;
use App\Form\PlayerCharacterType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EncounterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'required' => true,
                'label' => 'Nom de la rencontre : ',
                'attr' => [
                    'placeholder' => 'Nom de la rencontre',
                ],
            ])
            ->add('players', EntityType::class, [
                'class' => PlayerCharacter::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'placeholder' => 'Sélectionnez des personnages joueurs',
                'attr' => [
                    'class' => 'select2',
                ],
            ])
            ->add('monsters', EntityType::class, [
                'class' => Monster::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'placeholder' => 'Sélectionnez des monstres',
                'attr' => [
                    'class' => 'select2',
                ],
            ])
            // ->add('newPlayerCharacters', CollectionType::class, [
            //     'entry_type' => PlayerCharacterType::class,
            //     'entry_options' => [
            //         'label' => false,
            //     ],
            //     'allow_add' => true,
            //     'allow_delete' => true,
            //     'by_reference' => false,
            //     'label' => 'Nouveaux personnages joueurs',
            //     'required' => false,
            //     'mapped' => false,
            // ])
            // ->add('newMonsters', CollectionType::class, [
            //     'entry_type' => MonsterType::class,
            //     'entry_options' => [
            //         'label' => false,
            //     ],
            //     'allow_add' => true,
            //     'allow_delete' => true,
            //     'by_reference' => false,
            //     'label' => 'Nouveaux monstres',
            //     'required' => false,
            //     'mapped' => false,
            // ])
            // ->add('addNewPlayerCharacter', SubmitType::class, [
            //     'label' => 'Ajouter un nouveau personnage joueur',
            //     'attr' => [
            //         'class' => 'btn btn-primary',
            //         'onclick' => 'addNewPlayerCharacter(event)',
            //     ],
            // ])
            // ->add('addNewMonster', SubmitType::class, [
            //     'label' => 'Ajouter un nouveau monstre',
            //     'attr' => [
            //         'class' => 'btn btn-primary',
            //         'onclick' => 'addNewMonster(event)',
            //     ],
            // ])
            // ->add('save', SubmitType::class, [
            //     'label' => 'Enregistrer',
            //     'attr' => [
            //         'class' => 'btn btn-primary',
            //     ],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Encounter::class,
        ]);
    }
}

