<?php

/* 
Default controller displays the landing page
*/
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Project;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $project = $this->getDoctrine()->getRepository(Project::class)->findAll();

        if (!$project) {
            return $this->render('default/index.html.twig', [
                'controller_name' => 'DefaultController',
                'project' => $project,
            ]);
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'project' => $project,
        ]);
    }
}
