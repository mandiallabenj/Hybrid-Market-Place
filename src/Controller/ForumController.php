<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ArticleType;
use App\Entity\Article;

class ForumController extends AbstractController
{
    /**
     * @Route("/forum", name="forum")
     */
    public function forum()
    {
        $article = new Article();
        
        $form = $this->createForm(ArticleType::class, $article);
        
        
        return $this->render('forum/forum.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
