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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ReponseType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder //Creer le questionnaire de réponse d'une annonce
            // Commenter pour futur évolution
            /*
            ->add('participe',    			ChoiceType::class, array(
                    'label' => 'Participez-vous',
                    'choices' => array(
                        'Je participe' => 0,
                        'Je souhaite des informations complémentaires' => 1,
                    ),
                        'required' => false))
            */
            ->add('informations',    	TextareaType::class, array(
                'label' => 'Je souhaite des informations Complémentaires',
                'required' => true))
       
            ->add('save', SubmitType::class, array('label' => 'Envoyer'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Reponse',
        ]);
    }
}
