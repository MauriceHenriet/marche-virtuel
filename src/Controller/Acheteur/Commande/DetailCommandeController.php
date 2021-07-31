<?php

namespace App\Controller\Acheteur\Commande;

use App\MesServices\CartServices\CartService;
use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DetailCommandeController extends AbstractController
{
    /**
     * @Route("/profile/commande/detail/{id}", name="profile_commande_detail")
     */
    public function detailCommande(int $id, CommandeRepository $commandeRepository):Response
    {
        $commande = $commandeRepository->find($id);
        $fdp = $commande->getLigneCommandes()[0]->getProduit()->getBoutique()->getFdp();

        return $this->render('acheteur/commande/detail.html.twig', [
            'commande' => $commande,
            'fdp' => $fdp
        ]);
    }
}