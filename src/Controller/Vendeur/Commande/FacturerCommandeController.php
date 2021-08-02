<?php

namespace App\Controller\Vendeur\Commande;

use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FacturerCommandeController extends AbstractController
{
    /**
     * @Route("/vendeur/commande/facturer/{id}", name="vendeur_commande_facturer")
     */
    public function facturer(int $id, CommandeRepository $commandeRepository)
    {
        $commande = $commandeRepository->find($id);
        
        if($commande->getStatus() ==  'a-facturer')
        {
            // formulaire
            // if issubmited $commande->setStatus('attente-paiement');
        }

        return $this->redirectToRoute('vendeur_commandes_show');
    }

}