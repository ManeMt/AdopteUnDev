<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\JobAdd;
use App\Entity\Location;
use App\Entity\ProgramingLanguage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('postTitle')
            ->add('level')
            ->add('salary')
            ->add('description')
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'entitled',
            ])
            ->add('programingLanguages', EntityType::class, [
                'class' => ProgramingLanguage::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('company', EntityType::class, [
                'class' => Company::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobAdd::class,
        ]);
    }
}
