<?php

namespace App\Controller\Vendeur\Commande;

use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExpedierCommandeController extends AbstractController
{
    /**
     * @Route("/vendeur/commande/expedier/{id}", name="vendeur_commande_expedier")
     */
    public function expedier(int $id, CommandeRepository $commandeRepository)
    {
        $commande = $commandeRepository->find($id);
        
        if($commande->getStatus() ==  'en-livraison')
        {
            // formulaire
            // if issubmited $commande->setStatus('livree');
        }

        return $this->redirectToRoute('vendeur_commandes_show');
    }

}