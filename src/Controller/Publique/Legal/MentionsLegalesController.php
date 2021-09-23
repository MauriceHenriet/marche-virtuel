<?php

namespace App\Controller\Publique\Legal;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MentionsLegalesController extends AbstractController
{   
    /**
     * @Route("/mentions-legales/", name="public_mentions_legales")
     */
    public function mentionsLegales(): Response
    {
        return $this->render("public/legal/mentions_legales.html.twig");
    }
}