<?php

namespace App\Form;

use App\Entity\PlayerCharacter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerCharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
        {
    
            $builder
                ->add('name')
                ->add('hp')
                ->add('ac', IntegerType::class, [
                    'required' => false,
                    'label' => 'Classe d\'armure (AC)',
                    'attr' => [
                        'placeholder' => 'Classe d\'armure (AC)',
                    ],
                ])
        ;
        $playerCharacter = $options['data'] ?? null;

        if ($playerCharacter instanceof PlayerCharacter) {
            $builder->setData($playerCharacter);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlayerCharacter::class,
            'show_ac' => false, // Valeur par défaut de l'option personnalisée 'show_ac'

        ]);
    }
}
