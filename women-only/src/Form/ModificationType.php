<?php
namespace App\Form;

use App\Entity\TransportType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder //a modifié avec les besoins de mes annonces
        ->add('startplace',     TextType::class, array(
            'label' => 'Ville de départ',
            'required' => true))
            ->add('placearrived',   TextType::class, array(
                'label' => 'Ville d\'arrivée',
                'required' => true))
            ->add('startdate',      DateTimeType::class, array(
                'label' => 'Jour de départ',
                'required' => true))
            ->add('arrivalDate',    DateTimeType::class, array(
                'label' => 'Jour d\'arrivée',
                'required' => true))
            ->add('title',          TextType::class, array(
                'label' => 'Titre de l\'annonce',
                'required' => true,
                'help' => 'ex: Aller/Retour à Paris en train'))
            ->add('description',    TextareaType::class, array(
                'label' => 'Descritpion',
                'required' => true))
            //Appel les transports qui se trouvent dans ma base de données.
            ->add('transportType',  EntityType::class, array(
                'label' => 'Type de transport',
                'class' => TransportType::class,
                'choice_label'=> 'name',
                'required' => true
            ))
            //->add('transportType',    TextType::class)
            //->add('placeNumber',    TextType::class)
            // Published ne me sert pas car c'est pour qu'un admin valide l'annonce.
            //->add('published', CheckboxType::class)
            ->add('save', SubmitType::class, array(
                'label' => 'Modifier votre annonce',
                'attr' => ['class' => 'float-left btn-info']))
            ->add('delete', SubmitType::class, array(
                'label' => 'Supprimer votre annonce',
                'attr' => ['class' => 'float-right btn-info']
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Annonce',
        ]);
    }
}