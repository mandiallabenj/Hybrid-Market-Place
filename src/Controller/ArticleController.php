<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        return new Response('Index page');
        /*
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
         * 
         */
    }
    
    /*
     * @Route("/news/why")
     */
    
    public function show(){
        
        return new Response('Future page');
        
    }
}
