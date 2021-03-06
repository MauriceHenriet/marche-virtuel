<?php

namespace App\Controller\Acheteur;

use App\MesServices\CartServices\CartService;
use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SidebarController extends AbstractController
{
    /**
     * @Route("/acheteur/sidebar", name="acheteur_sidebar")
     */
    public function alert(CartService $cartService, CommandeRepository $commandeRepository)
    {
        $user = $this->getUser();

        $nbCommandesAttente = 0;
        $commandesEnLivraison = $commandeRepository->findCommandesAcheteurLivraison($user);
        $nbCommandesAttente = count($commandesEnLivraison);

        $nbArticles = $cartService->countArticles();


        return $this->render('acheteur/shared/_sidebar.html.twig', [
            'nbArticles' => $nbArticles,
            'nbCommandesAttente' => $nbCommandesAttente
        ]);
    }
}