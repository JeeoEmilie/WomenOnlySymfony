<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Contact;
use App\Form\ContactType;



class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function indexAction(Request $request,
        \Swift_Mailer $mailer)
    {
        // Creer l'objet du formulaire
        $contact = new Contact();

        // Creer le formulaire a partir de la class contact (fichier Form/ContactType.php)
        $form = $this->createForm(ContactType::class, $contact);

        // Lié le formulaire a la page
        $form->handleRequest($request);

        // Verifie si le formulaire a été envoyé & valide
        if ($form->isSubmitted() && $form->isValid()) {

            // Récupère le gestionnaire des entitées
            $entityManager = $this->getDoctrine()->getManager();

            // Ajoute l'entitée au gestionnaire
            $entityManager->persist($contact);

            // Insert en base les données
            $entityManager->flush();

            // Créer l'email pour informer d'un nouveau message
            $message = (new \Swift_Message('Contact'))
                ->setFrom($contact->getEmail())
                ->setTo('womenonly.contact@gmail.com')
                ->setBody(
                    "pseudo: " . $contact->getPseudo() .
                    "<br />objet: " . $contact->getObjet() .
                    "<br />message: " . $contact->getMessage(),
                    'text/html'
                );
            // Envoi le mail à l'équipe admin
            $mailer->send($message);

            // Affiche un message d'information
            $this->addFlash('notice', 'Un mail a été envoyé à l\'équipe d\'administration');

            // Renvoi sur la page home
            return $this->redirectToRoute('app_contact');
        }

        // Nom du repertoire/Nom du fichier
        return $this->render('contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}


