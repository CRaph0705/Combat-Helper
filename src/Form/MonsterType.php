<?php

namespace App\Form;

use App\Entity\Monster;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonsterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

    $builder
        ->add('name', TextType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('hp' , IntegerType::class, [
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('ac', IntegerType::class, [
            'required' => false,
            'label' => 'AC',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('strength', IntegerType::class, [
            'required' => false,
            'label' => 'STR',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('dexterity', IntegerType::class, [
            'required' => false,
            'label' => 'DEX',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('constitution', IntegerType::class, [
            'required' => false,
            'label' => 'CON',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('intelligence', IntegerType::class, [
            'required' => false,
            'label' => 'INT',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('wisdom', IntegerType::class, [
            'required' => false,
            'label' => 'WIS',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('charisma', IntegerType::class, [
            'required' => false,
            'label' => 'CHA',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('difficulty', TextType::class, [
            'required' => false,
            'label' => 'FP',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('speed', TextType::class, [
            'required' => false,
            'label' => 'SPD',
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ;
        $monster = $options['data'] ?? null;
        if ($monster instanceof Monster) {
            $builder->setData($monster);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Monster::class,
            'show_ac' => false,
            'monstersAvailable' => null,
            'monstersAdded' => null,
        ]);
    }
}
