<?php

namespace App\Form;

use App\Entity\Monster;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Size;
use App\Entity\Type;
use App\Entity\Alignment;
use App\Entity\Challenge;

class MonsterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

    $builder
        ->add('name', TextType::class, [
            'label' => 'Nom',
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('hp' , IntegerType::class, [
            'label' => 'HP',
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
            'label' => 'Force',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('dexterity', IntegerType::class, [
            'required' => false,
            'label' => 'Dextérité',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('constitution', IntegerType::class, [
            'required' => false,
            'label' => 'Constitution',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('intelligence', IntegerType::class, [
            'required' => false,
            'label' => 'Intelligence',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('wisdom', IntegerType::class, [
            'required' => false,
            'label' => 'Sagesse',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('charisma', IntegerType::class, [
            'required' => false,
            'label' => 'Charisme',
            'attr' => [
                'min' => 0,
                'class' => 'form-control',
            ],
        ])
        ->add('challenge', EntityType::class, [
            'required' => false,
            'label' => 'Dangerosité',
            'class' => Challenge::class,
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('groundspeed', IntegerType::class, [
            'required' => false,
            'label' => 'Au sol',
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('climbspeed', IntegerType::class, [
            'required' => false,
            'label' => 'Escalade',
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('burrowspeed', IntegerType::class, [
        'required' => false,
        'label' => 'Fouissement',
        'attr' => [
            'class' => 'form-control',
        ],
        ])

        ->add('swimspeed', IntegerType::class, [
            'required' => false,
            'label' => 'Nage',
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('flyspeed', IntegerType::class, [
            'required' => false,
            'label' => 'Vol',
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('size', EntityType::class, [
            'class' => Size::class,
            'label' => 'Taille',
            'required' => false,
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('type', EntityType::class, [
            'class' => Type::class,
            'label' => 'Type',
            'required' => false,
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('subtype', TextType::class, [
            'required' => false,
            'label' => 'Sous-type',
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('alignment', EntityType::class, [
            'class' => Alignment::class,
            'required' => false,
            'label' => 'Alignement',
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
