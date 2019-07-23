<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Issues;
use App\Entity\Collaborator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserProfileController extends AbstractController {

    /**
     * @Route("/profile", name="user_profile")
     */
    public function profile() {

        return $this->render('user_profile/profile.html.twig');
    }

    /**
     * @Route("/profile/projects", name="user_projects")
     */
    public function profileprojects() {

        $this->denyAccessUnlessGranted('ROLE_USER');
        $id = $this->getUser()->getId();


        /*

          if(!$user){

          throw $this->createNotFoundException(
          'Can not Access this Project '
          );
          }
         */


        $project = $this->getDoctrine()->getRepository(Project::class)->findByUser($id);
        $cproject = $this->getDoctrine()->getRepository(Collaborator::class)->findAll();
        $iproject = $this->getDoctrine()->getRepository(Issues::class)->findAll();

        return $this->render('user_profile/userprojects.html.twig', [
                    'project' => $project,
                    'cproject' => $cproject,
                    'iproject' => $iproject
        ]);
    }

    /**
     * @Route("user/post/review", name="post_review")
     */
    public function postreviews() {
        
    }

    /**
     * @Route("/profile/collaborator/requests", name="collaborator_requests")
     */
    public function collaboratorRequests() {

        $this->denyAccessUnlessGranted('ROLE_USER');
        $id = $this->getUser()->getId();

        
        $project = $this->getDoctrine()->getRepository(Project::class)->findByUser($id);
        $crproject = $this->getDoctrine()->getRepository(Collaborator::class)->findAll();


        return $this->render('user_profile/collaboratorRequests.html.twig', [
                    'project' => $project,
                    'crproject' => $crproject
        ]);
    }

    /**
     * @Route("/profile/purchases", name="user_purchases")
     */
    public function purchases() {

        return $this->render('user_profile/purchases.html.twig');
    }

}
