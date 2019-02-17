<?php
namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder //a modifié avec les besoins de mes annonces
            ->add('pseudo',     TextType::class, array(
            'label' => 'Pseudo:',
            'required' => true))
            ->add('email',   EmailType::class, array(
                'label' => 'Votre adresse email:',
                'required' => true))
            ->add('objet',      TextType::class, array(
                'label' => 'Objet de votre demande:',
                'required' => true))
            ->add('message',    TextareaType::class, array(
                'label' => 'Votre Message:',
                'required' => true))

            // Published ne me sert pas car c'est pour qu'un admin valide l'annonce.
            //->add('published', CheckboxType::class)
            ->add('save', SubmitType::class, array('label' => 'Envoyer votre message'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Contact',
        ]);
    }
}