<?php
// src/Controller/FaqController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FaqController extends AbstractController
{
    /**
     * @Route("/Faq", name="app_faq")
     */
    public function indexAction()
    {
		// Nom du repertoire/Nom du fichier
        return $this->render('/faq.html.twig');
    }
}