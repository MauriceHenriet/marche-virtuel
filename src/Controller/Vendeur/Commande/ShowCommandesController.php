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
        $commandesAFacturer = $commandeRepository->getCommandesAfacturer($vendeur);

        $commandesAttentePaiement = $commandeRepository->getCommandesAttentePaiement();

        $commandesAEnvoyer = $commandeRepository->getCommandesAEnvoyer();

        $commandesLivraison = $commandeRepository->getCommandesLivraison();
    }

}