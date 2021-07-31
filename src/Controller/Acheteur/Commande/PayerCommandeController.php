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
    public function payerCommande(int $id, CommandeRepository $commandeRepository, ShippingCostExtension $shippingCost)
    {
        dd($shippingCost->getShippingCost());
    }
}