<?php

namespace App\Form;

use App\Entity\PlayerCharacter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerCharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $showAc = $options['show_ac'];
    
            $builder
                ->add('name')
                ->add('hp')
                ->add('ac', null, [
                    'required' => false,
                    'label' => 'Classe d\'armure (AC)',
                    'attr' => [
                        'placeholder' => 'Classe d\'armure (AC)',
                    ],
                    'mapped' => $showAc, // Utiliser cette option pour afficher ou non le champ 'ac'
                ])
                ->add('initiative')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlayerCharacter::class,
            'show_ac' => false, // Valeur par défaut de l'option personnalisée 'show_ac'

        ]);
    }
}
