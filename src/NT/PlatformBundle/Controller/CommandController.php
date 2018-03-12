<?php

// src/NT/PlatformBundle/Controller/CommandController.php

namespace NT\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use NT\PlatformBundle\Entity\Command;
use NT\PlatformBundle\Entity\Ticket;
use NT\PlatformBundle\Entity\Tarif;
use NT\PlatformBundle\Form\CommandType;


class CommandController extends Controller
{

  public function indexAction(Request $request)
  {
      
    $command = new Command();
    $ticket = new Ticket();
    $command->addTicket($ticket);
    $form = $this->get('form.factory')->create(CommandType::class, $command);
//    $maxTickets = $this
//    ->getDoctrine()
//    ->getManager()
//    ->getRepository('NTPlatformBundle:Ticket')
//    ->maxDixBilletsDate()
//  ;
      
//    $tp = $this
//    ->getDoctrine()
//    ->getManager()
//    ->getRepository('NTPlatformBundle:Ticket')
//    ->TotalPrice()
//  ;
      
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      
    $dateresa= $ticket->getVisitDay(); // Calcul en fonction de la date actuelle
    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('NTPlatformBundle:Tarif')
//    ->findPriceByCommand
    ;

    $petit = $repository->find(9);
    $enfant = $repository->find(6);
    $adulte = $repository->find(5);
    $senior = $repository->find(7);
    $discount = $repository->find(8);
    $demiEnfant = $repository->find(2);
    $demiAdulte = $repository->find(1);
    $demiSenior = $repository->find(3);
    $demiDiscount = $repository->find(4);

      foreach ($command->getTickets() as $ticket) {

            //Calcul de l'âge du client
            $birthday = $ticket->getBirthday();           
            $interval = date_diff($dateresa, $birthday);
            $age = $interval->y;
          
            //Calcul de l'heure après 14h
            print date('H:i');
            $hourtwo = date('H:i');
          
//              $th = $this
//              ->getDoctrine()
//              ->getManager()
//              ->getRepository('NTPlatformBundle:Ticket')
//              ->TwoHours();

            //Calcul du prix grâce à l'âge et aux réductions
            
            //Prix des demi-journées
            if ($ticket->getHalfDay() == true || $ticket->getVisitday() == date("d-m-Y H:i")){
                //Prix tarif réduit demi-journée
                if($ticket->getDiscount() == true){
                    $ticket->setTarif($demiDiscount);
                }
                else if ($age < 4) {
                    $ticket->setTarif($petit);
                }
                else if ($age >= 4 && $age <= 12) {
                    $ticket->setTarif($demiEnfant);
                }
                else if ($age >= 60) {
                    $ticket->setTarif($demiSenior);
                }
                else if ($age > 12 && $age < 60) {
                    $ticket->setTarif($demiAdulte);
                }      
            }
//            else if($th == true){
//                $ticket->getHalfDay() == true;
//            }
            //Prix tarif réduit
            else if($ticket->getDiscount() == true){
                    $ticket->setTarif($discount);
            }    
            else{ //Prix des journées entières
                if ($age < 4) {
                    $ticket->setTarif($petit);
                }
                else if ($age >= 4 && $age <= 12) {
                    $ticket->setTarif($enfant);
                }
                else if ($age >= 60) {
                    $ticket->setTarif($senior);
                }
                else if ($age > 12 && $age < 60) {
                     $ticket->setTarif($adulte);
                }
                
            }
            
            //Incrémentation de $totalprice pour le calcul du prix total
//            $ticketPrice = $repository->findPriceByCommand();
//            $totalPrice = $totalPrice + $ticketPrice;
//            $command->setTotalPrice($totalPrice);
      }
      $em->persist($command);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Commande bien enregistrée.');

      return $this->redirectToRoute('nt_platform_validationform', array(
          'id' => $command->getId()
              ));
    }
    return $this->render('NTPlatformBundle:Command:index.html.twig', array(
        'form' => $form->createView(),
//        'tp' => $tp
    ));
    
  }
  
  public function validationformAction()
  {
    // ...

    

    // Et modifiez le 2nd argument pour injecter notre liste
    return $this->render('NTPlatformBundle:Command:validationform.html.twig');
  }
  
  public function paymentAction()
  {
    
    // Set your secret key: remember to change this to your live secret key in production
    // See your keys here: https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey("sk_test_PyCD5Ru2mqMqhsxRzouiJ5JW");

    // Token is created using Stripe.js or Checkout!
    // Get the payment token ID submitted by the form:
    $token = $_POST['stripeToken'];
    $price = 2000;
    // Charge the user's card:
    $charge = \Stripe\Charge::create(array(
      "amount" => $price,
      "currency" => "eur",
      "description" => "Example charge",
      "source" => $token,
    ));
    

    // Et modifiez le 2nd argument pour injecter notre liste
    return $this->render('NTPlatformBundle:Command:payment.html.twig');
  }
  
   
  
}