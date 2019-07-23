<?php

/*

Admin Controller contains all method for admin.
Username: admin
password: pass_1234

*/



namespace App\Controller;

use App\Entity\Project;
use App\Entity\User;
use App\Entity\Collaborator;
use App\Entity\Issues;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {

    /**
     * @Route("/admin", name="admin")
     * IsGranted("ROLE_ADMIN")
     */
    public function index() {
        return $this->render('admin/index.html.twig', [
                    'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     * IsGranted("ROLE_ADMIN")
     */
    public function adminDashboard() {

        $TotalNumberOfUsers = $this->getDoctrine()->getRepository(User::class)->findNumberOfUsers();
        $Project = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $totalNumberOfProject = $this->getDoctrine()->getRepository(Project::class)->findAllNumberOfProjects();


        return $this->render('admin/admindashboard.html.twig', [
                    'TotalNumberOfUsers' => $TotalNumberOfUsers,
                    'totalNumberOfProject' => $totalNumberOfProject,
        ]);
    }

    /**
     * @Route("/admin/dashboard/Users", name="all_users")
     * IsGranted("ROLE_ADMIN")
     */
    public function allUsers() {

        $TotalNumberOfUsers = $this->getDoctrine()->getRepository(User::class)->findNumberOfUsers();
        $Project = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $totalNumberOfProject = $this->getDoctrine()->getRepository(Project::class)->findAllNumberOfProjects();


        return $this->render('admin/admindashboardallusers.html.twig', [
                    'TotalNumberOfUsers' => $TotalNumberOfUsers,
                    'totalNumberOfProject' => $totalNumberOfProject,
        ]);
    }

    /**
     * @Route("/admin/dashboard/projects", name="all_projects")
     * IsGranted("ROLE_ADMIN")
     */
    public function allProjects() {

        $TotalNumberOfUsers = $this->getDoctrine()->getRepository(User::class)->findNumberOfUsers();
        $project = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $cproject = $this->getDoctrine()->getRepository(Collaborator::class)->findAll();
        $iproject = $this->getDoctrine()->getRepository(Issues::class)->findAll();
        $totalNumberOfProject = $this->getDoctrine()->getRepository(Project::class)->findAllNumberOfProjects();


        return $this->render('admin/admindashboardallprojects.html.twig', [
                    'TotalNumberOfUsers' => $TotalNumberOfUsers,
                    'totalNumberOfProject' => $totalNumberOfProject,
                    'project' => $project,
                    'cproject' => $cproject,
                    'iproject' => $iproject
        ]);
    }

    /**
     * @Route("/admin/dashboard/projects/{id}/block", name="block_project")
     * IsGranted("ROLE_ADMIN")
     */
    public function blockproject($id) {
        $TotalNumberOfUsers = $this->getDoctrine()->getRepository(User::class)->findNumberOfUsers();
        $project = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $cproject = $this->getDoctrine()->getRepository(Collaborator::class)->findAll();
        $iproject = $this->getDoctrine()->getRepository(Issues::class)->findAll();
        $totalNumberOfProject = $this->getDoctrine()->getRepository(Project::class)->findAllNumberOfProjects();

        $blockproject = $this->getDoctrine()->getRepository(Project::class)->find($id);

        $blockproject->setIsblocked('YES');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', 'Project Was blocked Successfully!');



        return $this->render('admin/admindashboardallprojects.html.twig', [
                    'controller_name' => 'AdminController',
                    'TotalNumberOfUsers' => $TotalNumberOfUsers,
                    'totalNumberOfProject' => $totalNumberOfProject,
                    'project' => $project,
                    'cproject' => $cproject,
                    'iproject' => $iproject
        ]);
    }

    /**
     * @Route("/admin/dashboard/projects/{id}/unblock", name="unblock_project")
     * IsGranted("ROLE_ADMIN")
     */
    public function unblockproject($id) {

        $TotalNumberOfUsers = $this->getDoctrine()->getRepository(User::class)->findNumberOfUsers();
        $project = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $cproject = $this->getDoctrine()->getRepository(Collaborator::class)->findAll();
        $iproject = $this->getDoctrine()->getRepository(Issues::class)->findAll();
        $totalNumberOfProject = $this->getDoctrine()->getRepository(Project::class)->findAllNumberOfProjects();

        $unblockproject = $this->getDoctrine()->getRepository(Project::class)->find($id);

        $unblockproject->setIsblocked('NO');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', 'Project Was unblocked Successfully!');



        return $this->render('admin/admindashboardallprojects.html.twig', [
                    'TotalNumberOfUsers' => $TotalNumberOfUsers,
                    'totalNumberOfProject' => $totalNumberOfProject,
                    'project' => $project,
                    'cproject' => $cproject,
                    'iproject' => $iproject
        ]);
    }

    /**
     * @Route("/admin/dashboard/projects/{id}/approveproject", name="approve_project")
     */
    public function approveproject($id) {

        $TotalNumberOfUsers = $this->getDoctrine()->getRepository(User::class)->findNumberOfUsers();
        $project = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $cproject = $this->getDoctrine()->getRepository(Collaborator::class)->findAll();
        $iproject = $this->getDoctrine()->getRepository(Issues::class)->findAll();
        $totalNumberOfProject = $this->getDoctrine()->getRepository(Project::class)->findAllNumberOfProjects();

        $blockproject = $this->getDoctrine()->getRepository(Project::class)->find($id);

        $blockproject->setIsApproved('YES');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', 'Project Was Approved Successfully!');



        return $this->render('admin/admindashboardallprojects.html.twig', [
                    'controller_name' => 'AdminController',
                    'TotalNumberOfUsers' => $TotalNumberOfUsers,
                    'totalNumberOfProject' => $totalNumberOfProject,
                    'project' => $project,
                    'cproject' => $cproject,
                    'iproject' => $iproject
        ]);
    }

    /**
     * Admin function to disapprove project
     * @Route("/admin/{id}/disapproveproject", name="disapprove_project")
     */
    public function disapproveproject($id) {

        $TotalNumberOfUsers = $this->getDoctrine()->getRepository(User::class)->findNumberOfUsers();
        $project = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $cproject = $this->getDoctrine()->getRepository(Collaborator::class)->findAll();
        $iproject = $this->getDoctrine()->getRepository(Issues::class)->findAll();
        $totalNumberOfProject = $this->getDoctrine()->getRepository(Project::class)->findAllNumberOfProjects();

        $blockproject = $this->getDoctrine()->getRepository(Project::class)->find($id);

        $blockproject->setIsApproved('NO');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', 'Project Was Disapproved Successfully!');



        return $this->render('admin/admindashboardallprojects.html.twig', [
                    'controller_name' => 'AdminController',
                    'TotalNumberOfUsers' => $TotalNumberOfUsers,
                    'totalNumberOfProject' => $totalNumberOfProject,
                    'project' => $project,
                    'cproject' => $cproject,
                    'iproject' => $iproject
        ]);
    }

    /**
     * @Route("/admin/dashboard/projects/enterprise", name="all_projects_enterprise")
     * IsGranted("ROLE_ADMIN")
     */
    public function allProjectsEnterprise() {

        $TotalNumberOfUsers = $this->getDoctrine()->getRepository(User::class)->findNumberOfUsers();
        $Project = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $totalNumberOfProject = $this->getDoctrine()->getRepository(Project::class)->findAllNumberOfProjects();


        return $this->render('admin/admindashboardallprojectsEnterprise.html.twig', [
                    'TotalNumberOfUsers' => $TotalNumberOfUsers,
                    'totalNumberOfProject' => $totalNumberOfProject,
        ]);
    }

}
