<?php

namespace App\Controller\Publique\Produit;

use App\Repository\ProduitRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit/{producteurSlug}/{produitSlug}/{id}", name="produit")
     */
    public function show(int $id, ProduitRepository $produitRepository)
    {
        $produit = $produitRepository->find($id);

        if(!$produit)
        {
            $this->addFlash('warning', 'Ce produit n\'existe pas.');
            // mieux vaut renvoyer vers la liste des catégories ?
            return $this->redirectToRoute("liste_producteur");
        }

        // proposer aussi des produits de la région
        // proposer aussi des produits de la boutique : FACIL
        // proposer des produits de la même catégorie
        return $this->render('public/produit/produit.html.twig', [
            'produit' => $produit
        ]);
    }
}