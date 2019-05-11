<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContributorController extends AbstractController
{
    /**
     * @Route("/contributor", name="contributor")
     */
    public function index()
    {
        return $this->render('contributor/index.html.twig', [
            'controller_name' => 'ContributorController',
        ]);
    }
}
