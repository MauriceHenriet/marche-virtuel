<?php

namespace App\Controller\Publique\Legal;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PolitiqueCookiesController extends AbstractController
{   
    /**
     * @Route("/politique-cookies/", name="public_politique_cookies")
     */
    public function politiqueCookies(): Response
    {
        return $this->render("public/legal/politique_cookies.html.twig");
    }
}