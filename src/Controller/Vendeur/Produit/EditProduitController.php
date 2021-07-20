<?php

namespace App\Controller\Vendeur\Produit;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditProduitController extends AbstractController
{
    /**
     * @Route("vendeur/produit/edit/{id}", name="edit_produit")
     */
    public function edit(int $id, ProduitRepository $produitRepository):Response
    {
        $produit = $produitRepository->find($id);

        if(!$produit)
        {
            $this->addFlash('warning', 'Ce produit n\'existe pas.');
            return $this->redirectToRoute("vendeur_home");
        }

        return $this->render('vendeur/produit/edit.html.twig', [
            'produit' => $produit
        ]);
    }
}