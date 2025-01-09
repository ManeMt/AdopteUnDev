<?php

namespace App\Form;

use App\Entity\JobAdd;
use App\Entity\Location;
use App\Entity\ProgramingLanguage;
use App\Entity\Company;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobAddType2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('postTitle', TextType::class, [
                'label' => 'Job Title',
            ])
            ->add('level', IntegerType::class, [
                'label' => 'Level',
            ])
            ->add('salary', NumberType::class, [
                'label' => 'Salary',
                'scale' => 2, // To handle decimal values
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Job Description',
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name',
                'label' => 'Location',
            ])
            ->add('programingLanguages', EntityType::class, [
                'class' => ProgramingLanguage::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true, // Display checkboxes for multiple languages
                'label' => 'Programming Languages',
            ]);
            // ->add('company', EntityType::class, [
            //     'class' => Company::class,
            //     'choice_label' => 'name',
            //     'label' => 'Company',
            // ])
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobAdd::class,
        ]);
    }
}
