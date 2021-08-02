<?php

namespace App\Controller\Acheteur\Commande;

use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AnnulerCommandeController extends AbstractController
{
    /**
     * @Route("/profile/commande/annuler/{id}", name="profile_commande_annuler")
     */
    public function annuler(int $id, CommandeRepository $commandeRepository):Response
    {
        $commande = $commandeRepository->find($id);
        
        if($commande->getStatus() == 'a-facturer' || $commande->getStatus() == 'attente-paiement')
        {
            $commande->setStatus('annulee');
        }

        return $this->redirectToRoute('profile_commandes_show');
    }
}