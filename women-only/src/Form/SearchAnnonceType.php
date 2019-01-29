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

class SearchAnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder //a modifié avec les besoins de mes annonces
            ->add('startplace',     TextType::class, array(
                'label' => 'Ville de départ', 
                'required' => false))
            ->add('placearrived',   TextType::class, array(
                'label' => 'Ville d\'arrivée', 
                'required' => false))
            ->add('startdate',      DateTimeType::class, array(
                'label' => 'Jour de départ', 
                'required' => false))
            //->add('arrivalDate',    DateTimeType::class, array(
            //   'label' => 'Jour d\'arrivée', 
            //   'required' => true))
          
            ->add('Search', SubmitType::class, array('label' => 'Rechercher un trajet'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\DTO\SearchAnnonce',
        ]);
    }
}