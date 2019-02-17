<?php
//Pour afficher les annonces dans une nouvelle page
// src/Controller/AnnonceController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AnnonceRepository;
use App\Entity\Reponse;
use App\Form\ReponseType;
use App\Form\ModificationType;

class AnnonceController extends AbstractController
{

    /**
     * @Route("/annonce/{id}", name="app_annonce")
     */
    public function indexAction(AnnonceRepository $repository, Request $request, $id, \Swift_Mailer $mailer)
    {
    	$annonce = $repository->find($id);

    	//Si l'annonce n'est pas trouvé il declenche un message d'erreur
		if ($annonce === null) {
    		throw $this->createNotFoundException('Annonce introuvable');
		}

		// Creer l'objet du formulaire
        $reponse = new Reponse();
        $reponse->setParticipe(0);

         // Creer le formulaire a partir de la class reponse (fichier Form/SearchAnnonceType.php)
        $form = $this->createForm(ReponseType::class, $reponse);

        // Lié le formulaire a la page
        $form->handleRequest($request);

        // Verifie si le formulaire a été envoyé & valide
        if ($form->isSubmitted() && $form->isValid()) {

			// Récupère l'utilisateur actuellement connecter
    		$user = $this->getUser();

        	// Je déclare l'utilisateur de l'annonce et l'annonce
        	$reponse->setUser($user);
        	$reponse->setAnnonce($annonce);

	    	// Récupère le gestionnaire des entitées
	    	$entityManager = $this->getDoctrine()->getManager();

	    	// Ajoute l'entitée au gestionnaire
            $entityManager->persist($reponse);

            // Insert en base les données
            $entityManager->flush();

            // Envoi du mail et Créer l'email pour informer d'un nouveau message
            $message = (new \Swift_Message('Informations'))
                ->setFrom($annonce->getUser()->getEmail())
                ->setTo($user->getEmail())
                ->setBody(
                    "Bonjour " . $annonce->getUser()->getPseudo() .
                    "<br />L'utilisateur " . $user->getPseudo() . " vous contacte concernant votre annonce : " .
                    "<a href='" . $this->generateUrl('app_annonce', array( 'id' => $annonce->getId())) . "'>" . $annonce->getTitle() . "</a>" .
                    "Merci de lui répondre.",
                    'text/html'
                );

            // Envoi le mail à l'équipe admin
            $mailer->send($message);

            // Affiche un message d'information
            $this->addFlash('notice', 'Un mail a été envoyé au proprietaire de l\'annonce');


            // Renvoi sur la page home
            return $this->redirectToRoute('app_annonce', array( 'id' => $id));
        }

        // Initialise mes variables
        $reponses = array();
        $userReponses = array();

        // Commenter pour futur évolution
        /*
        // Récupère l'utilisateur actuellement connecter
        $user = $this->getUser();

        // Verifie que l'utilisateur est connecté
        if ( $user != null) {

            // Récupère le depot de l'entité reponse
            $repositoryReponse = $this->getDoctrine()->getRepository(Reponse::class);

            //On récupère toutes les annonces seulement si l'utilisateur courant est celui de l'annonce
            if( $user == $annonce->getUser()){
                $reponses = $repositoryReponse->findBy(array(
                    'annonce' => $annonce));
            }

            // Récupère les réponses de l'utilisateur courant
            $userReponses = $repositoryReponse->findBy(array(
                'annonce' => $annonce,
                'user' => $user));
        }
        */

		// Nom du repertoire/Nom du fichier
        return $this->render('annonce.html.twig', array(
            'form' => $form->createView(),
            'annonce' => $annonce,
            'reponses' => $reponses,
            'userReponses' => $userReponses
        ));
    }


    /**
     * @Route("/annonce/edit/{id}", name="app_annonce_edit")
     */
    public function editAction(AnnonceRepository $repository, Request $request, $id)
    {
        $annonce = $repository->find($id);

        //Si l'annonce n'est pas trouvé il declenche un message d'erreur
        if ($annonce === null) {
            throw $this->createNotFoundException('Annonce introuvable');
        }

        // Creer le formulaire a partir de la class annonce (fichier Form/AnnonceType.php)
        $form = $this->createForm(ModificationType::class, $annonce);

        // Lié le formulaire a la page
        $form->handleRequest($request);

        // Verifie si le formulaire a été envoyé & valide
        if ($form->isSubmitted() && $form->isValid()) {

            // Récupère le gestionnaire des entitées
            $entityManager = $this->getDoctrine()->getManager();

            // Action si on clique sur le bouton Save.
            if ($form->get('save')->isClicked())
            {
                // Modifier l'entitée au gestionnaire
                $entityManager->persist($annonce);

                // Insert en base les données
                $entityManager->flush();

                // Renvoi sur la page home
                return $this->redirectToRoute('app_annonce', array( 'id' => $annonce->getId()));
            }

            // Action si on clique sur le bouton delete.
            if ($form->get('delete')->isClicked())
            {
                // Recupère les réponses de l'annonce
                $reponses = $annonce->getReponses();

                if (count($reponses) > 0) {

                    // Affiche un message d'information
                    $this->addFlash('error', 'Impossible de supprimer l\'annonce car elle contient des réponses !');


                    // Renvoi sur la page home
                    return $this->redirectToRoute('app_annonce', array( 'id' => $annonce->getId()));
                }

                // Supprime l'annonce.
                $entityManager->remove($annonce);

                // Envoi l'instruction à la base les données
                $entityManager->flush();

                // Renvoi sur la page home
                return $this->redirectToRoute('app_profile');
            }
        }

        // Nom du repertoire/Nom du fichier
        return $this->render('modification.html.twig', array(
            'form' => $form->createView(),
            'annonce' => $annonce,
        ));
    }

}