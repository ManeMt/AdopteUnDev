<?php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationDevType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'attr' => [
                    'placeholder' => 'Entrez votre adresse email',
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Entrez votre mot de passe',
                ]
                ])
                // ->add('passwordConfirm', PasswordType::class, [
                //     'label' => 'Confirmé Mot de passe',
                //     'attr' => [
                //         'placeholder' => 'Entrez votre mot de passe',
                //     ]
                // ])
                ;
            // ->add('roles', ChoiceType::class, [
            //     'label' => 'Rôle utilisateur',
         
            //     'choices' => [
            //         'Développeur' => 'ROLE_DEV',
            //         'Entreprise' => 'ROLE_COMPANY',
            //     ],
            //     'multiple' => false,
            //     'expanded' => true, 
            //     'attr' => [
            //         'class' => 'roles-radio ml-3',
            //     ],
            
            // ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class, // Lie ce formulaire à l'entité User
        ]);
    }
}

