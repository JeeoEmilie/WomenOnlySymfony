<?php
// src/Controller/QuiController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuiController extends AbstractController
{
    /**
     * @Route("/qui", name="app_qui")
     */
    public function indexAction()
    {
		// Nom du repertoire/Nom du fichier
        return $this->render('/qui.html.twig');
    }
}