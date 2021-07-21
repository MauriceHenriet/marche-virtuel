<?php

namespace App\Controller\Publique;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{   
    /**
     * @Route("/", name="public_home")
     */
    public function home(Request $request, Security $security): Response
    {
        return $this->render("public/home.html.twig");
        
    }
}