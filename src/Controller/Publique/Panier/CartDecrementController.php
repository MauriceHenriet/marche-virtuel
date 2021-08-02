<?php

namespace App\Controller\Publique\Panier;

use App\Repository\ProduitRepository;
use App\MesServices\CartServices\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartDecrementController extends AbstractController
{
    /**
     * @Route("/cart/decrement/{id}", name="cart_decrement", requirements={"id":"\d+"})
     */
    public function decrement(CartService $cartService, int $id, 
            ProduitRepository $productRepository, Request $request)
    {
        $produit = $productRepository->find($id);
        $boutiqueId = $produit->getBoutique()->getId();

        if(!$produit)
        {
            $this->addFlash('warning', 'Ce produit n\'existe pas.');
            return $this->redirectToRoute('public_home');
        }

        $cartService->decrement($id, $boutiqueId);

        $this->addFlash('success', 'le produit '. $produit->getNom() .' a bien été soustrait du panier.');

        return $this->redirectToRoute('cart_show');

    }
}