<?php

namespace App\Form;

use App\Entity\EncounterMonster;
use App\Entity\Monster;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EncounterMonsterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('monster', EntityType::class, [
                'class' => Monster::class,
                'label' => 'Monster',
                'required' => true,
            ])
            ->add('encounter')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EncounterMonster::class,
        ]);
    }
}
