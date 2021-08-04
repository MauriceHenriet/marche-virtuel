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

        $commandesAttentePaiement = $commandeRepository->findCommandesAcheteurAttentePaiement($user);

        $nbArticles = $cartService->countArticles();

        $nbCommandesAPayer= count($commandesAttentePaiement);

        return $this->render('acheteur/shared/_sidebar.html.twig', [
            'nbArticles' => $nbArticles,
            'nbCommandesAPayer' => $nbCommandesAPayer
        ]);
    }
}