<?php

namespace App\Controller\Vendeur\Commande;

use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SidebarCommandeController extends AbstractController
{
    /**
     * @Route("/vendeur/sidebar", name="vendeur_sidebar")
     */
    public function alert(CommandeRepository $commandeRepository)
    {
        $vendeur = $this->getUser();

        $boutiques = $vendeur->getBoutiques();

        $commandesAFacturer = [];
        $commandesAExpedier = [];

        $nbCommandesATraiter = 0;

        foreach($boutiques as $boutique)
        {
            $commandesAFacturer = array_merge( $commandesAFacturer, $commandeRepository->findCommandesBoutiqueAfacturer($boutique) );
            $commandesAExpedier = array_merge( $commandesAExpedier , $commandeRepository->findCommandesBoutiqueAExpedier($boutique) );
        }

        $nbCommandesATraiter = count($commandesAFacturer) + count($commandesAExpedier);

        return $this->render('vendeur/shared/_sidebar.html.twig', [
            'nbCommandesATraiter' => $nbCommandesATraiter
        ]);
    }
}