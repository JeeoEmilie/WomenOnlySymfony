<?php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('pseudo', TextType::class, array(
                'label' =>'register.pseudo.label',
                'required' => true,
                'help' => 'register.pseudo.help'))
            ->add('nom', TextType::class, array('label' => 'Nom', 'required' => true, 'help' => 'ex: Micky'))
            ->add('prenom', TextType::class, array('label' => 'Prénom', 'required' => true, 'help' => 'ex: Micky'))
            ->add('birthdate', BirthdayType::class, array('label' => 'Date de naissance', 'required' => true))
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'first_options' => ['label' => 'Votre adresse email', 'required' => true],
                'second_options' => ['label' => 'Confirmation adresse email', 'required' => true],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe', 'required' => true],
                'second_options' => ['label' => 'Confirmation mot de passe', 'required' => true],
            ]);
             $builder
                 ->add('pseudo')
                 ->add('email')
                 ->add('roles', choiceType::class,[
                     'multiple' => true,
                     'choices' => [
                         'User'=> 'ROLE_USER',
                         'Admin'=> 'ROLE_ADMIN',

                     ]
                 ])
                 ->add('password')

            ->add('save', SubmitType::class, array('label' => 'S\'inscrire'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\User',
        ]);
    }
}