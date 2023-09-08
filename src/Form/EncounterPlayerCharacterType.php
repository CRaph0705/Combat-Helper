<?php

namespace App\Form;

use App\Entity\EncounterPlayerCharacter;
use App\Entity\PlayerCharacter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EncounterPlayerCharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('playerCharacter', EntityType::class, [
                'class' => PlayerCharacter::class,
                // 'label' => 'Player Character',
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EncounterPlayerCharacter::class,
        ]);
    }
}
