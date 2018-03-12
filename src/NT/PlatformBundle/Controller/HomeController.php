<?php

// src/NT/PlatformBundle/Controller/HomeController.php

namespace NT\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeController extends Controller
{

   
   public function indexAction($page)
  {
    $maxTickets = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('NTPlatformBundle:Ticket')
    ->MaxDixBilletsDate()
  ;


    

    return $this->render('NTPlatformBundle:Home:index.html.twig', array(
          'tickets' => $maxTickets
              ));
  }
   
    
}