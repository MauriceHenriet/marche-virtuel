<?php

namespace App\Controller\Vendeur\Commande;

use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailCommandeController extends AbstractController
{
    /**
     * @Route("/vendeur/commande/detail/{id}", name="vendeur_commande_detail")
     */
    public function detail(int $id, CommandeRepository $commandeRepository)
    {
        $commande = $commandeRepository->find($id);
        $fdp = $commande->getLigneCommandes()[0]->getProduit()->getBoutique()->getFdp();

        return $this->render('vendeur/commande/detail.html.twig', [
            'commande' => $commande,
            'fdp' => $fdp
        ]);
    }

}