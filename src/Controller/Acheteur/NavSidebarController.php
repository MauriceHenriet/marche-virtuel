<?php

namespace App\Controller\Acheteur;

use App\MesServices\CartServices\CartService;
use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NavSidebarController extends AbstractController
{
    /**
     * @Route("/acheteur/navsidebar", name="acheteur_navSidebar")
     */
    public function alert(CartService $cartService, CommandeRepository $commandeRepository)
    {
        $user = $this->getUser();

        $nbCommandesAttente = 0;
        $commandesEnLivraison = $commandeRepository->findCommandesAcheteurLivraison($user);
        $nbCommandesAttente = count($commandesEnLivraison);

        $nbArticles = $cartService->countArticles();


        return $this->render('acheteur/shared/_navSidebar.html.twig', [
            'nbArticles' => $nbArticles,
            'nbCommandesAttente' => $nbCommandesAttente
        ]);
    }
}