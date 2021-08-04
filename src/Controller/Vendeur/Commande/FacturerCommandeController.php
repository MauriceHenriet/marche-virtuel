<?php

namespace App\Controller\Vendeur\Commande;

use App\Entity\Facture;
use App\Repository\CommandeRepository;
use App\Repository\FactureRepository;
use Doctrine\ORM\EntityManagerInterface;
use FFI;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FacturerCommandeController extends AbstractController
{
    /**
     * @Route("/vendeur/commande/facturer/{id}", name="vendeur_commande_facturer")
     */
    public function facturer(int $id, CommandeRepository $commandeRepository, 
                        EntityManagerInterface $em, 
                        FactureRepository $factureRepository)
    {
        $commande = $commandeRepository->find($id);
        $idBoutique = $commande->getBoutique()->getId();
        
        if($commande->getStatus() ==  'a-facturer')
        {
            $lastFactureTab = $factureRepository->findLastFacture($idBoutique.'-');

            // si première facture dans la BDD
            if(empty($lastFactureTab))
            {
                $lastFacture = new Facture();
                $lastFacture->setNumero("idBoutique-2021-0");
                $lastFactureTab[] = $lastFacture;
            }

            // on récupère le dernier chiffre de la dernière facture
            $lastNumFacture = explode('-', $lastFactureTab[0]->getNumero() )[2];

            // creation de la facture
            $facture = new Facture;
            $facture->setCommande($commande);
            $facture->setCreatedAt(new \DateTime());
            $facture->setStatus('a-payer');
            $facture->setNumero( $idBoutique."-".date('Y')."-".($lastNumFacture+1) );

            $em->persist($facture);
            
            $commande->setStatus('attente-paiement');
            $em->persist($commande);

            $em->flush();

        }

        return $this->redirectToRoute('vendeur_commandes_show');
    }

}