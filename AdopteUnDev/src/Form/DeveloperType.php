<?php

namespace App\Form;

use App\Entity\Developer;
use App\Entity\ProgramingLanguage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DeveloperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
  
    $builder
        ->add('firstName', TextType::class, [
            'label' => 'Prénom',
            'required' => true,
        ])
        ->add('lastName', TextType::class, [
            'label' => 'Nom',
            'required' => true,
        ])
        ->add('minSalary', NumberType::class, [
            'label' => 'Salaire minimum',
            'required' => true,
        ])
        ->add('level', ChoiceType::class, [
            'label' => 'Niveau d\'expérience',
            'choices' => [
                '1 - Débutant' => 1,
                '2 - Junior' => 2,
                '3 - Intermédiaire' => 3,
                '4 - Senior' => 4,
                '5 - Expert' => 5,
            ],
            'required' => true,
            'placeholder' => 'Sélectionnez votre niveau', // Placeholder en français
        ])
        ->add('biography', TextareaType::class, [
            'label' => 'Biographie',
            'required' => true,
        ])
        ->add('avatar', FileType::class, [
            'label' => 'Avatar (optionnel)',
            'required' => false,
            'mapped' => false, // Prevents Doctrine from handling the file directly
        ])
        ->add('programingLanguages', EntityType::class, [
            'class' => ProgramingLanguage::class,
            'choice_label' => 'entitled',
            'multiple' => true,
            'expanded' => false,
            'label' => 'Langages de programmation',
        ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Developer::class,
        ]);
    }
}
