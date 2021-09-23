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

        $commandesAExpedier = [];
        $nbCommandesAExpedier = 0;

        foreach($boutiques as $boutique)
        {
            $commandesAExpedier = array_merge( $commandesAExpedier , $commandeRepository->findCommandesBoutiqueAExpedier($boutique) );
        }

        $nbCommandesAExpedier = count($commandesAExpedier);

        return $this->render('vendeur/shared/_sidebar.html.twig', [
            'nbCommandesATraiter' => $nbCommandesAExpedier
        ]);
    }
}