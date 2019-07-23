<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Project;
use App\Entity\Screenshot;
use App\Entity\Issues;
use App\Entity\Projectfiles;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MarketPlaceController extends AbstractController {

    /**
     * @Route("/marketplace", name="marketplace")
     */
    public function show() {
        $project = $this->getDoctrine()->getRepository(Project::class)->findAll();

        if (!$project) {
            throw $this->createNotFoundException(
                    'No projects yet found for id '
            );
        }

        return $this->render('market_place/marketplace.html.twig', [
                    'project' => $project,
        ]);
    }

    /**
     * @Route("/marketplace/view/{id}", name="marketplace_show_project")
     */
    public function showproject(Request $request, $id) {

        //display screenshote by project

        $screenshot = $this->getDoctrine()->getRepository(Screenshot::class)->findScreenshotsByProject($id);

        // Total Number of Files By Project

        $numberOffilesByProject = $this->getDoctrine()->getRepository(Projectfiles::class)->findNumberOffilesByProject($id);

        // Fetch Files By Project
        $projectfile = $this->getDoctrine()->getRepository(Projectfiles::class)->findAllfilesByProject($id);

//fetch project by id
        $project = $this->getDoctrine()->getRepository(Project::class)->findOneProject($id);

        // fetch all issues related to this projecct

        $NumberOfIssues = $this->getDoctrine()->getRepository(Issues::class)->findNumberOfIssuesOfProject($id);

        $issues = $this->getDoctrine()->getRepository(Issues::class)->findAllIssuesOfProject($id);
        //$issue_author = $this->getDoctrine()->getRepository(Issues::class)->findAllIssuesOfProject($id)->getUser()->getUsername();
// creates an issues and gives it some dummy data for this example
        $issue = new Issues();


        $form = $this->createFormBuilder($issue)
                ->add('issue', TextareaType::class, ['label' => 'Type issues'])
                ->add('Report', SubmitType::class)
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->denyAccessUnlessGranted('ROLE_USER');
            $user = $this->getUser();

            $issue = $form->getData();
            $issue->setUser($user);
            $issue->setProject($project);
            $issue->setCreatedAt(new \DateTime('now'));


// saving issue on project
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($issue);
            $entityManager->flush();
        }

        if (!$project) {
            throw $this->createNotFoundException(
                    'No projects yet found for id '
            );
        }

        return $this->render('market_place/showproject.html.twig', [
                    'title' => $id,
                    'project' => $project,
                    'issues' => $issues,
                    'NumberOfIssues' => $NumberOfIssues,
                    'projectfile' => $projectfile,
                    'numberOffilesByProject' => $numberOffilesByProject,
                    'screenshot' => $screenshot,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/marketplace/search" ,name="marketplace_search")
     */
    public function searchApp(Request $request) {

        $q = $request->query->get('q');

        $project = $this->getDoctrine()->getRepository(Project::class)->findAllSearchBy($q);

        return $this->render('market_place/marketplace.html.twig', [
                    'project' => $project,
        ]);
    }

}
