<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, array('label' => 'Pseudo', 'required' => true))
            ->add('nom', TextType::class, array('label' => 'Nom', 'required' => true))
            ->add('prenom', TextType::class, array('label' => 'Prénom', 'required' => true))
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'first_options' => ['label' => 'Votre adresse email', 'required' => true],
                'second_options' => ['label' => 'Confirmation adresse email', 'required' => true],
            ])
            //->add('avatarFile', FileType::class, ['label' => 'Avatar (JPG file)'])
            ->add('save', SubmitType::class, array('label' => 'Modifier'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\User',
        ]);
    }
}