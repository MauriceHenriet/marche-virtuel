<?php

namespace App\Controller\Acheteur\Commande;

use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LivreeCommandeController extends AbstractController
{
    /**
     * @Route("/profile/commande/livree/{id}", name="profile_commande_livree")
     */
    public function livree(int $id, CommandeRepository $commandeRepository):Response
    {
        $commande = $commandeRepository->find($id);
        
        if($commande->getStatus() ==  'en-livraison')
        {
            // formulaire
            // if issubmited $commande->setStatus('livree');
        }

        return $this->redirectToRoute('profile_commandes_show');
    }
}