<?php
// src/Controller/CommentController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment-ca-marche", name="app_comment_ca_marche")
     */
    public function indexAction()
    {
		// Nom du repertoire/Nom du fichier
        return $this->render('comment/comment.html.twig');
    }
}