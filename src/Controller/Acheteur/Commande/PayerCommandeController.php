<?php

namespace App\Controller\Acheteur\Commande;

use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PayerCommandeController extends AbstractController
{
    /**
     * @Route("/profile/commande/payer/{id}", name="profile_commande_payer")
     */
    public function payerCommande(int $id, CommandeRepository $commandeRepository, EntityManagerInterface $em)
    {
        $commande = $commandeRepository->find($id);

        if($_REQUEST != null)
        {
            $dateCarte = $_REQUEST['annee-expire'] .$_REQUEST['mois-expire'];

            if( $_REQUEST['num1'] != "" && $_REQUEST['num2'] != "" && $_REQUEST['num3'] != "" &&
                $_REQUEST['num4'] != "" && $_REQUEST['nom'] != "" && $_REQUEST['num-complementaire'] != ""
                 &&  $dateCarte >= date("Ym") )
                {
                    if($commande->getStatus() == 'attente-paiement')
                    {
                        $facture = $commande->getFacture();
                        $facture->setStatus('payee');
                        $facture->setPaidAt(new \DateTime());
                        $em->persist($facture);

                        $commande->setStatus('a-expedier');
                        $em->persist($commande);

                        $em->flush();

                        return $this->redirectToRoute('profile_commandes_show');
                    }
                }
        }
        return $this->render('acheteur/commande/payer.html.twig');

    }
}

