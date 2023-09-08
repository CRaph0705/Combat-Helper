<?php

namespace App\Form;

use App\Entity\EncounterMonster;
use App\Entity\Monster;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
                // 'label' => 'Monster',
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control encounter-monster-select',
                ],
            ])
            ->add('quantity', IntegerType::class, [ // Add the quantity field
                // 'label' => 'Quantity',
                'label' => false,
                'required' => true,
                'attr' => [
                    'min' => 1,
                    'step' => 1,
                    'class' => 'form-control encounter-monster-quantity',
                ],
                'data' => 1,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EncounterMonster::class,
        ]);
    }
}
