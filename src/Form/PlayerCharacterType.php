<?php

namespace App\Form;

use App\Entity\PlayerCharacter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerCharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('hp')
            ->add('ac')
            ->add('initiative')
            ->add('hpMax')
            ->add('conditions')
            ->add('encounterLists')
        ;
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlayerCharacter::class,
        ]);
    }
}
