<?php

namespace App\Controller\Vendeur;

use App\Repository\ProduitRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/vendeur/", name="vendeur_home")
     */
    public function home()
    {
        $user = $this->getUser();

        $boutiques = $user->getBoutiques();

        return $this->render("vendeur/home.html.twig", [
            'boutiques' => $boutiques
        ]);
    }
}