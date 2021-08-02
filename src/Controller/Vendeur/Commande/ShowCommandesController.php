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

        $commandesAFacturer = [];
        $commandesAttentePaiement = [];
        $commandesAExpedier = [];
        $commandesEnLivraison = [];
        $commandesLivree = [];
        $commandesAnnulee = [];
        $commandesRefusee = [];

        foreach($boutiques as $boutique)
        {
            $commandesAFacturer = array_merge( $commandesAFacturer, $commandeRepository->findCommandesBoutiqueAfacturer($boutique) );
            // $commandesAfacturer[] = $commandeRepository->findCommandesBoutiqueAfacturer($boutique);

            $commandesAttentePaiement = array_merge($commandesAttentePaiement, $commandeRepository->findCommandesBoutiqueAttentePaiement($boutique) ) ;

            $commandesAExpedier = array_merge( $commandesAExpedier , $commandeRepository->findCommandesBoutiqueAExpedier($boutique));
    
            $commandesEnLivraison = array_merge( $commandesEnLivraison , $commandeRepository->findCommandesBoutiqueEnLivraison($boutique) );

            $commandesLivree = array_merge( $commandesLivree , $commandeRepository->findCommandesBoutiqueLivree($boutique) );

            $commandesAnnulee = array_merge( $commandesAnnulee, $commandeRepository->findCommandesBoutiqueAnnulee($boutique) );

            $commandesRefusee = array_merge( $commandesRefusee, $commandeRepository->findCommandesBoutiqueRefusee($boutique) );
        }



        return $this->render('vendeur/commande/show.html.twig', [
            'commandesAFacturer' => $commandesAFacturer,
            'commandesAttentePaiement' => $commandesAttentePaiement,
            'commandesAExpedier' => $commandesAExpedier,
            'commandesEnLivraison' => $commandesEnLivraison,
            'commandesLivree' => $commandesLivree,
            'commandesAnnulee' => $commandesAnnulee,
            'commandesRefusee' => $commandesRefusee
        ]);
    }

}