<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Issues;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/home", name="home")
     */
    public function homepage() {

        $Total_Number_of_Projects = $this->getDoctrine()->getRepository(Project::class)->findAllNumberOfProjects();

        $issue = $this->getDoctrine()->getRepository(Issues::class)->findAllIssues();
        //$issue_project = $issue->getProject()->getTitle();
        //$issue_author = $issue->getUser()-getUsername();

        $project = $this->getDoctrine()->getRepository(Project::class)->findAll();

        
        return $this->render('home/home.html.twig', [
                    'project' => $project,
                    'issue' => $issue,
                    'Total_Number_of_Projects' => $Total_Number_of_Projects,
            //'issue_project' =>$issue_project,
           // 'issue_author' => $issue_author,
        ]);
    }

}
