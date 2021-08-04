<?php

namespace App\Controller\Vendeur\Commande;

use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RefuserCommandeController extends AbstractController
{
    /**
     * @Route("/vendeur/commande/refuser/{id}", name="vendeur_commande_refuser")
     */
    public function refuser(int $id, CommandeRepository $commandeRepository, EntityManagerInterface $em)
    {
        $commande = $commandeRepository->find($id);
        
        if($commande->getStatus() ==  'a-facturer')
        {
            $commande->setStatus('refusee');
            
            $em->persist($commande);
            $em->flush();
        }


        return $this->redirectToRoute('vendeur_commandes_show');
    }

}