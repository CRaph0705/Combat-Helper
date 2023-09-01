<?php

namespace App\Form;

use App\Entity\Monster;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonsterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

    $builder
        ->add('name')
        //hp cannot be negative
        ->add('hp' , IntegerType::class, [
            'attr' => [
                'min' => 0,
            ],
        ])
        ->add('ac', IntegerType::class, [
            'required' => false,
            'label' => 'Armor Class (AC)',
            'attr' => [
                'min' => 0,
                'placeholder' => 'Armor Class (AC)',
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
