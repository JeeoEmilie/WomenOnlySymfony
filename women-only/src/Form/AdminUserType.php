<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdminUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('roles', choiceType::class,[
                'multiple' => true,
                'choices' => [
                    'User'=> 'ROLE_USER',
                    'Admin'=> 'ROLE_ADMIN',
                    'SuperAdmin'=> 'ROLE_SUPER_ADMIN',

                ]
            ])
            ->add('password')
            ->add('pseudo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
