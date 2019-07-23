<?php

namespace App\Controller;

use App\Entity\Collaborator;
use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CollaboratorType;

class CollaboratorController extends AbstractController {

    /**
     * @Route("/collaborator/{id}/make/request", name="become_collaborator")
     */
    public function becomeCollaborator(Request $request, $id) {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();


        $project = $this->getDoctrine()->getRepository(Project::class)->findOneProject($id);

        $collaborator = new Collaborator();
        $form = $this->createForm(CollaboratorType::class, $collaborator);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (true === $form['agreeToTerms']->getData()) {

                $collaborator = $form->getData();
                $collaborator->setIsAccepted('NO');
                $collaborator->setUser($user);
                $collaborator->setProject($project);


// save to db
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($collaborator);
                $entityManager->flush();
                
                $this->addFlash('success', 'Your request to collaborate on this project was submitted successfully!');
            }
        }

        return $this->render('collaborator/becomeCollaborator.html.twig', [
                    'project' => $project,
                    'form' => $form->createView()
        ]);
    }

    /*
     * @Route("/collaborator/requests" , name="collaborator_requests")
     */
    
    public function collaboratorRequests($id) {
        
        $cRequest = $this->getDoctrine()->getRepository(Collaborator::class);
        
    }
}
