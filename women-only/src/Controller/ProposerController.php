<?php
// src/Controller/ProposerController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProposerController extends AbstractController
{
    /**
     * @Route("/proposer", name="app_proposer")
     */
    public function indexAction()
    {
		// Nom du repertoire/Nom du fichier
        return $this->render('proposer/proposer.html.twig');
    }
}