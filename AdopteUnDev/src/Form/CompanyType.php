<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Sector;
use App\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de l'entreprise",
            ])
            ->add('logo', FileType::class, [
                'label' => 'Logo',
                'required' => false,
                'mapped' => false,
                'attr' => ['accept' => 'image/*'],
            ])
            ->add('banner', FileType::class, [
                'label' => 'Image de banière',
                'required' => false,
                'mapped' => false,
                'attr' => ['accept' => 'image/*'],
            ])
            ->add('images', FileType::class, [
                'label' => 'Autres images (multiple)',
                'required' => false,
                'mapped' => false,
                'multiple' => true,
                'attr' => ['accept' => 'image/*'],
            ])
            ->add('website', UrlType::class, [
                'label' => 'Website URL',
                'required' => false,
            ])
            ->add('contact', TextType::class, [
                'label' => 'Contact',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Brève Description',
            ])
            ->add('sector', EntityType::class, [
                'class' => Sector::class,
                'choice_label' => 'entitled',
                'label' => 'Secteur d\' activité',
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'entitled',
                'label' => 'Localisation / Ville',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
