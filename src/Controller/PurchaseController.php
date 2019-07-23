<?php

/*
  This represents the payment module
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Project;
use App\Entity\Projectfiles;

class PurchaseController extends AbstractController {

    /**
     * purchase function where user selects form of payment
     * @Route("/purchase/{id}", name="purchase")
     */
    public function index($id) {
        /*
          id as one of the parameters
         */


        $project = $this->getDoctrine()->getRepository(Project::class)->findOneProject($id);


        /*
          this renders the view to select form payment
         */
        return $this->render('purchase/purchase.html.twig', [
                    'project' => $project,
        ]);
    }

    /**
     * checkout function upon purchasing a project
     * @Route("/checkout/{id}", name="checkout")
     */
    public function checkout(Request $request, $id) {
        $project = $this->getDoctrine()->getRepository(Project::class)->findOneProject($id);
        $projectfile = $this->getDoctrine()->getRepository(Projectfiles::class)->findAllfilesByProject($id);

        if ($request->isMethod('POST')) {
            $token = $request->request->get('stripeToken');

            \Stripe\Stripe::setApiKey($this->getParameter('stripe_secret_key'));

            /** @var User $user * */
            $user = $this->getUser();

            if (!$user->getStripeCustomerId()) {
                \Stripe\Stripe::setApiKey($this->getParameter('stripe_secret_key'));

               $customer =  \Stripe\Customer::create([
                    'email' => $user->getEmail(),
                    'source' => $token // obtained with Stripe.js
                ]);
                
                $user->setStripeCustomerId($customer->id);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            }
            
            else{
                $customer = \Stripe\Customer::retrieve($user->getStripeCustomerId());
                $customer->source = $token;
                $customer->save();
            }


            \Stripe\Charge::create([
                
                "customer" => $user->getStripeCustomerId(),
                'receipt_email'=>$user->getEmail(),       
                "amount" => 900,
                "currency" => "usd",
                "description" => $project->getTitle()
            ]);


            $this->addFlash('success', 'Payment Complete For : ' . $project->getTitle());

            return $this->render('purchase/success.html.twig', [
                        'project' => $project,
                        'projectfile' => $projectfile
            ]);
        }


        /*
          this renders the to process payment by use of the stripe api
         */

        return $this->render('purchase/checkout.html.twig', [
                    'project' => $project,
                    'stripe_public_key' => $this->getParameter('stripe_public_key')
        ]);
    }

}
