<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Issues;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserProfileController extends AbstractController {

    /**
     * @Route("/user/profile", name="user_profile")
     */
    public function index() {

        return $this->render('user_profile/index.html.twig', [
                    'controller_name' => 'UserProfileController',
        ]);
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


        return $this->render('user_profile/userprojects.html.twig', [
                    'project' => $project
        ]);
    }

            

    /**
     * @Route("user/post/review", name="post_review")
     */
    public function postreviews() {
        
    }

}
