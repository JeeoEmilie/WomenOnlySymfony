<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder //a modifié avec les besoins de mes annonces
            ->add('pseudo', TextType::class, array('label' => 'Pseudo', 'required' => true, 'help' => 'ex: Micky'))
            ->add('nom', TextType::class, array('label' => 'Nom', 'required' => true, 'help' => 'ex: Micky'))
            ->add('prenom', TextType::class, array('label' => 'Prénom', 'required' => true, 'help' => 'ex: Micky'))
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'first_options' => ['label' => 'Votre adresse email', 'required' => true],
                'second_options' => ['label' => 'Confirmation adresse email', 'required' => true],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe', 'required' => true],
                'second_options' => ['label' => 'Confirmation mot de passe', 'required' => true],
            ])
            ->add('save', SubmitType::class, array('label' => 'S\'inscrire'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Annonce',
        ]);
    }
}