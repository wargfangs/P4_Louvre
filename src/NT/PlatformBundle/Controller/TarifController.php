<?php

// src/NT/PlatformBundle/Controller/TarifController.php

namespace NT\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TarifController extends Controller
{

   
   public function indexAction($page)
  {
    // ...

    

    // Et modifiez le 2nd argument pour injecter notre liste
    return $this->render('NTPlatformBundle:Tarif:index.html.twig');
  }
   
    
}