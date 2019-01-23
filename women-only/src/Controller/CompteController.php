<?php
// src/Controller/CompteController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="app_compte")
     */
    public function indexAction()
    {
		// Nom du repertoire/Nom du fichier
        return $this->render('/compte.html.twig');
    }
}