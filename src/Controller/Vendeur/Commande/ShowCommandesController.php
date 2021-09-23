<?php

namespace App\Controller\Vendeur\Commande;

use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowCommandesController extends AbstractController
{
    /**
     * @Route("/vendeur/commandes/show", name="vendeur_commandes_show")
     */
    public function show(CommandeRepository $commandeRepository)
    {
        $vendeur = $this->getUser();
        $boutiques = $vendeur->getBoutiques();

        $commandesAExpedier = [];
        $commandesEnLivraison = [];
        $commandesLivree = [];

        foreach($boutiques as $boutique)
        {
            $commandesAExpedier = array_merge( $commandesAExpedier , $commandeRepository->findCommandesBoutiqueAExpedier($boutique));
    
            $commandesEnLivraison = array_merge( $commandesEnLivraison , $commandeRepository->findCommandesBoutiqueEnLivraison($boutique) );

            $commandesLivree = array_merge( $commandesLivree , $commandeRepository->findCommandesBoutiqueLivree($boutique) );
        }

        return $this->render('vendeur/commande/show.html.twig', [
            'commandesAExpedier' => $commandesAExpedier,
            'commandesEnLivraison' => $commandesEnLivraison,
            'commandesLivree' => $commandesLivree
        ]);
    }
}