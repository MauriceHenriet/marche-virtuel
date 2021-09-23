<?php

namespace App\Controller\Publique\Legal;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CGUController extends AbstractController
{   
    /**
     * @Route("/conditions-generales-utilisation/", name="public_cgu")
     */
    public function cgu(): Response
    {
        return $this->render("public/legal/cgu.html.twig");
    }
}