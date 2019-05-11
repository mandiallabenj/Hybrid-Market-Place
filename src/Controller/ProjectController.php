<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\User;
use App\Entity\Screenshot;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Form\ProjectType;
use App\Form\ScreenshotType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProjectController extends AbstractController {

    /**
     * @Route("/project", name="project")
     */
    public function index() {
        return $this->render('project/index.html.twig', [
                    'controller_name' => 'ProjectController',
        ]);
    }

    /**
     * @Route("/project/upload" ,name="project_upload") 
     */
    public function upload(Request $request) {


        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();

        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('icon')->getData();

            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            // Move the file to the directory where project icons are stored
            try {
                $file->move(
                        $this->getParameter('project_icon_directory'), $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }


            // updates the 'project_icon' property to store the image file name
            // instead of its contents
            $project->setIcon($fileName);
            $project->setPublishedAt(new \DateTime('now'));

            $project->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            $this->addFlash('success', 'Your Project Was Created!');

            return $this->render('project/projectupload.html.twig'
            );
        }

        return $this->render('project/projectupload.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/project/{id}/edit" ,name="project_edit") 
     */
    public function editproject(Request $request, $id) {



        $entityManager = $this->getDoctrine()->getManager();
        $project = $entityManager->getRepository(Project::class)->find($id);



        if (!$project) {
            throw $this->createNotFoundException(
                    'No product found for project ' . $project
            );
        }

        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();

        $form = $this->createForm(ProjectType::class, $project);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('icon')->getData();

            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                        $this->getParameter('project_icon_directory'), $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }




            // updates the 'project_icon' property to store the image file name
            // instead of its contents


            $project->setIcon($fileName);
            $project->setPublishedAt(new \DateTime('now'));
            $project->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Your Project Was Created!');

            return $this->render('project/projectfilesupload.html.twig', ['project' => $project]
            );
        }

        return $this->render('project/projectedit.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/project/{id}/screenshot", name="screenshot_upload")
     */
    public function uploadscreenshots(Request $request, $id) {

        $project = $this->getDoctrine()->getRepository(Project::class)->findOneProject($id);

        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();

        $projectscreenshot = new Screenshot ();



        $form = $this->createForm(ScreenshotType::class, $projectscreenshot);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $screenshot */
            $file = $form->get('screenshot')->getData();

            $screenshotName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            // Move the file to the directory where project icons are stored
            try {
                $file->move(
                        $this->getParameter('project_screenshot_directory'), $screenshotName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }


            // updates the 'screenshot' property to store the image file name
            // instead of its contents
            $projectscreenshot->setScreenshot($screenshotName);
            $projectscreenshot->setUser($user);
            $projectscreenshot->setProject($project);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projectscreenshot);
            $entityManager->flush();

            $this->addFlash('success', 'Your Screenshot Was Upload!');
            return $this->redirectToRoute('user_projects');
        }

        return $this->render('project/screenshotupload.html.twig', [
                    'project' => $project,
                    'form' => $form->createView(),
        ]);
    }
    
     /**
     * @Route("/project/screenshot/{id}/delete" ,name="screenshot_delete") 
     */
    public function deletescreenshot($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $screenshot = $entityManager->getRepository(Screenshot::class)->find($id);

        if (!$screenshot) {
            throw $this->createNotFoundException(
                    'No product found for id ' . $id
            );
        }

        $entityManager->remove($screenshot);
        $entityManager->flush();
        
        return $this->redirectToRoute('marketplace_show_project');

    }

    /**
     * @return string
     */
    private function generateUniqueFileName() {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    /**
     * @Route("/project/{id}/delete" ,name="project_delete") 
     */
    public function deleteproject($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $project = $entityManager->getRepository(Project::class)->find($id);

        if (!$project) {
            throw $this->createNotFoundException(
                    'No product found for id ' . $id
            );
        }

        $entityManager->remove($project);
        $entityManager->flush();

        return $this->render('user_profile/userprojects.html.twig');
    }

    /**
     * @Route("/project/{id}/donate" ,name="donate") 
     */
    public function donate($id) {

        $project = $this->getDoctrine()->getRepository(Project::class)->findOneProject($id);

        return $this->render('project/donate.html.twig', [
                    'project' => $project,
        ]);
    }

    /**
     * @Route("project/{id}/collection" , name="project_toggle_collection" , methods={"POST"})
     * @param type $id
     */
    public function addToCollections($id) {


        return new JsonResponse(['hearts' => rand(5, 100)]);
    }

}
