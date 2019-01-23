<?php
// src/Controller/RechercherController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RechercherController extends AbstractController
{
    /**
     * @Route("/rechercher", name="app_rechercher")
     */
    public function indexAction()
    {
		// Nom du repertoire/Nom du fichier
        return $this->render('rechercher/rechercher.html.twig');
    }
}