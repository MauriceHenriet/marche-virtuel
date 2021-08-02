<?php

namespace App\Controller\Acheteur\Commande;

use App\Repository\CommandeRepository;
use App\Twig\ShippingCostExtension;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PayerCommandeController extends AbstractController
{
    /**
     * @Route("/profile/commande/payer/{id}", name="profile_commande_payer")
     */
    public function payerCommande(int $id, CommandeRepository $commandeRepository)
    {
        $commande = $commandeRepository->find($id);
        
        if($commande->getStatus() == 'attente-paiement')
        {

            // faire la vue codepen credit avec formulaire 
            //et if submited  $commande->setStatus('a-expedier');
        }

        return $this->redirectToRoute('profile_commandes_show');
    }
}

