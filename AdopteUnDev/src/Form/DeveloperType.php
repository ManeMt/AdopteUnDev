<?php

namespace App\Form;

use App\Entity\Developer;
use App\Entity\ProgramingLanguage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeveloperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'First Name',
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last Name',
                'required' => true,
            ])
            ->add('minSalary', NumberType::class, [
                'label' => 'Minimum Salary',
                'required' => true,
            ])
            ->add('level', IntegerType::class, [
                'label' => 'Level',
                'required' => true,
            ])
            ->add('biography', TextareaType::class, [
                'label' => 'Biography',
                'required' => true,
            ])
            ->add('avatar', FileType::class, [
                'label' => 'Avatar (optional)',
                'required' => false,
                'mapped' => false, // Prevents Doctrine from handling the file directly
            ])
            ->add('programingLanguages', EntityType::class, [
                'class' => ProgramingLanguage::class,
                'choice_label' => 'entitled',
                'multiple' => true,
                'expanded' => false,
                'label' => 'Programming Languages',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Developer::class,
        ]);
    }
}
