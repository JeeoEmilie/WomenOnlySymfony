<?php
// src/Controller/ProposerController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Annonce;
use App\Form\AnnonceType;

class ProposerController extends AbstractController
{
    /**
     * @Route("/proposer", name="app_proposer")
     */
    public function indexAction(Request $request)
    {
    	// Récupère l'utilisateur actuellement connecter
    	$user = $this->getUser();

    	if($user == null) {
            // Renvoi sur la page connexion
            return $this->redirectToRoute('app_login');
    	}

    	// Creer l'objet du formulaire
        $annonce = new Annonce();

         // Creer le formulaire a partir de la class annonce (fichier Form/AnnonceType.php)
        $form = $this->createForm(AnnonceType::class, $annonce);

        // Lié le formulaire a la page
        $form->handleRequest($request);

        // Verifie si le formulaire a été envoyé & valide
        if ($form->isSubmitted() && $form->isValid()) {

        	// Je déclare l'utilisateur de l'annonce
        	$annonce->setUser($user);

	    	// Récupère le gestionnaire des entitées
	    	$entityManager = $this->getDoctrine()->getManager();

	    	// Ajoute l'entitée au gestionnaire
            $entityManager->persist($annonce);

            // Insert en base les données
            $entityManager->flush();

            // Renvoi sur la page home
            return $this->redirectToRoute('app_home');
        }

		// Nom du repertoire/Nom du fichier
        return $this->render('proposer.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

