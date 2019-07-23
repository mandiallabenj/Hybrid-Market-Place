<?php

/*

Enterprise controller has the following methods:

make enterprise();
cancel enterprise();


*/

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Project;

class EnterpriseController extends AbstractController {

    /**
     * @Route("/enterprise", name="enterprise")
     */
    public function enterprise() {
        return $this->render('enterprise/index.html.twig', [
                    'controller_name' => 'EnterpriseController',
        ]);
    }

    /**
     * @Route("/enterprise/apply" ,name="applY_for_enterprise")
     */
    public function applyForEnterprise($id) {


        $project = $this->getDoctrine()->getRepository(Project::class)->findOneProject($id);

        return $this->render('market_place/showproject.html.twig', [
                    'project' => $project,
        ]);
    }

    /**
     * @Route("/enterprise/register/{id}" ,name="make_enterprise")
     */
    public function makeEnterprise($id) {


        $project = $this->getDoctrine()->getRepository(Project::class)->find($id);
        $project->setIsEnterprise('YES');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', 'Your Project Was Created!');

        return $this->render('market_place/marketplace.html.twig', [
                    'project' => $project,
        ]);
    }

}
