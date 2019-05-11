<?php

namespace App\Controller;

use App\Entity\Collaborator;
use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CollaboratorType;

class CollaboratorController extends AbstractController
{
    /**
     * @Route("/collaborator/{id}/request", name="become_collaborator")
     */
    public function becomeCollaborator(Request $request, $id)
    {
        $project = $this->getDoctrine()->getRepository(Project::class)->findOneProject($id);
        
        $collaborator = new Collaborator();
        $form = $this->createForm(CollaboratorType::class, $collaborator);
        
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        if (true === $form['agreeToTerms']->getData()) {
               
            }
        }
        
        return $this->render('collaborator/becomeCollaborator.html.twig', [
            'project'=>$project,
            'form'=>$form->createView()            
        ]);
    }
}
