<?php
// src/Controller/RechercherController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Annonce;
use App\DTO\SearchAnnonce;
use App\Form\SearchAnnonceType;

class RechercherController extends AbstractController
{
    /**
     * @Route("/rechercher", name="app_rechercher")
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
        $searchAnnonce = new SearchAnnonce();

         // Creer le formulaire a partir de la class SearchAnnonce (fichier Form/SearchAnnonceType.php)
        $form = $this->createForm(SearchAnnonceType::class, $searchAnnonce);

        // Lié le formulaire a la page
        $form->handleRequest($request);

        // Récupère le depot de l'entité annonce
	    $repository = $this->getDoctrine()->getRepository(Annonce::class);

	    // Récupère la liste des annonces:
	    $annonces = array();

        // Verifie si le formulaire a été envoyé & valide
        if ($form->isSubmitted() && $form->isValid()) {

        	// Critère de recherche.
        	$criteria = array();

        	if ($searchAnnonce->startplace != '') {
        		$criteria['startplace'] = $searchAnnonce->startplace;
        	}

        	if ($searchAnnonce->placearrived != '') {
        		$criteria['placearrived'] = $searchAnnonce->placearrived;
        	}

        	if ($searchAnnonce->startdate != '') {
        		$criteria['startdate'] = $searchAnnonce->startdate;
        	}

        	/*if ($searchAnnonce->arrivalDate != '') {
        		$criteria['arrivalDate'] = $searchAnnonce->arrivalDate;
        	}*/

	    	$annonces = $repository->findBy($criteria);
        } else {
	    	$annonces = $repository->findAll();
        }

		// Nom du repertoire/Nom du fichier
        return $this->render('rechercher.html.twig', array(
            'form' => $form->createView(),
            'annonces' => $annonces
        ));
    }

}