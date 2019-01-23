<?php
// src/Controller/MentionsController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MentionsController extends AbstractController
{
    /**
     * @Route("/mentions", name="app_mentions")
     */
    public function indexAction()
    {
		// Nom du repertoire/Nom du fichier
        return $this->render('/mentions.html.twig');
    }
}