<?php

namespace App\Controller\Acheteur\Commande;

use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AnnulerCommandeController extends AbstractController
{
    /**
     * @Route("/profile/commande/annuler/{id}", name="profile_commande_annuler")
     */
    public function annuler(int $id, CommandeRepository $commandeRepository, EntityManagerInterface $em):Response
    {
        $commande = $commandeRepository->find($id);
        
        if($commande->getStatus() == 'a-facturer' || $commande->getStatus() == 'attente-paiement')
        {
            $commande->setStatus('annulee');

            $em->persist($commande);
            $em->flush();
        }

        return $this->redirectToRoute('profile_commandes_show');
    }
}