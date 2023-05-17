<?php

namespace App\Form;

use App\Entity\EncounterList;
use App\Entity\PlayerCharacter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EncounterListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('isPcList')
            // ->add('monsters')
            ->add('playerCharacters', EntityType::class, [
                'class' => PlayerCharacter::class,
                'label' => 'Ajouter un personnage à la liste',
                'choice_label' => 'name',
                // 'placeholder' => 'Sélectionnez un personnage',
                'required' => false,
                'multiple' => true,
                'expanded' => false,
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EncounterList::class,
        ]);
    }
}
