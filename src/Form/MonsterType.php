<?php

namespace App\Form;

use App\Entity\Monster;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonsterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    $showAc = $options['show_ac'];

    $builder
        ->add('name')
        ->add('hp')
        ->add('ac', null, [
            'required' => false,
            'label' => 'Armor Class (AC)',
            'attr' => [
                'placeholder' => 'Armor Class (AC)',
            ],
            'mapped' => $showAc, // Utiliser cette option pour afficher ou non le champ 'ac'
        ])
        ->add('initiative')
        ->add('quantity', IntegerType::class, [
            'label' => 'Quantity',
            'required' => false,
        ]);
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
