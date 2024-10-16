<?php

namespace App\Form;

use App\Entity\Monster;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use App\Entity\Size;
use App\Entity\Type;
use App\Entity\Alignment;
use App\Entity\Challenge;
use App\Entity\Language;
use App\Entity\State;
use App\Entity\Resistance;
use App\Entity\Immunity;
use App\Entity\Vulnerability;
use App\Entity\SavingThrow;
use App\Entity\ProficientSkill;
use App\Entity\ExpertSkill;

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
            //caractéristiques
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
            //déplacements
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
            // sens
            ->add('tremorsense', IntegerType::class, [
                'required' => false,
                'label' => 'Perception des vibrations',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('blindsight', IntegerType::class, [
                'required' => false,
                'label' => 'Vision aveugle',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('darkvision', IntegerType::class, [
                'required' => false,
                'label' => 'Vision dans le noir',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('truesight', IntegerType::class, [
                'required' => false,
                'label' => 'Vision parfaite',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            //Langues & communication
            ->add('languages', EntityType::class, [
                'class' => Language::class,
                'multiple' => true,
                // 'expanded' => true,
                'required' => false,
                'label' => 'Langues',
                'attr' => [
                    'class' => 'checkbox-container',
                ],
                // 'choice_attr' => function() {
                //     return [
                //         'class' => 'form-check-input'
                //     ];
                // },  
            ])

            ->add('customLanguage', TextType::class, [
                'required' => false,
                'label' => 'Langue personnalisée',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])

            ->add('telepathy', IntegerType::class, [
                'required' => false,
                'label' => 'Télépathie',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            //Résistances & vulnérabilités
            ->add('stateImmunity', EntityType::class, [
                'class' => State::class,
                'multiple' => true,
                'required' => false,
                'label' => 'Immunités aux états',
                'attr' => [
                    'class' => 'checkbox-container',
                ],
            ])
            ->add('damageImmunity', EntityType::class, [
                'class' => Immunity::class,
                'multiple' => true,
                'required' => false,
                'label' => 'Immunités aux dommages',
                'attr' => [
                    'class' => 'checkbox-container',
                ],
            ])
            ->add('damageResistance', EntityType::class, [
                'class' => Resistance::class,
                'multiple' => true,
                'required' => false,
                'label' => 'Résistances aux dommages',
                'attr' => [
                    'class' => 'checkbox-container',
                ],
            ])
            ->add('damageVulnerability', EntityType::class, [
                'class' => Vulnerability::class,
                'multiple' => true,
                'required' => false,
                'label' => 'Vulnérabilités aux dommages',
                'attr' => [
                    'class' => 'checkbox-container',
                ],
            ])
            ->add('actions', TextType::class, [
                'required' => false,
                'label' => 'Actions',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('reactions', TextType::class, [
                'required' => false,
                'label' => 'Réactions',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('legendaryActions', TextType::class, [
                'required' => false,
                'label' => 'Actions légendaires',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('savingThrows', EntityType::class, [
                'class' => SavingThrow::class,
                'multiple' => true,
                'required' => false,
                'label' => 'Jets de sauvegarde',
                'attr' => [
                    'class' => 'checkbox-container',
                ],
            ])

            ->add('proficientSkill', EntityType::class, [
                'class' => ProficientSkill::class,
                'multiple' => true,
                'required' => false,
                'label' => 'Compétences maîtrisées',
                'attr' => [
                    'class' => 'checkbox-container',
                ],
            ])
        

            ->add('expertSkill', EntityType::class, [
                'class' => ExpertSkill::class,
                'multiple' => true,
                'required' => false,
                'label' => 'Compétences expertes',
                'attr' => [
                    'class' => 'checkbox-container',
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
