<?php
// src/Controller/ConnexionController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConnexionController extends AbstractController
{
    /**
     * @Route("/connexion", name="app_connexion")
     */
    public function indexAction()
    {
		// Nom du repertoire/Nom du fichier
        return $this->render('/connexion.html.twig');
    }
}