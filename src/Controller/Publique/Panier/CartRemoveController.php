<?php

namespace App\Controller\Publique\Panier;

use App\Repository\ProduitRepository;
use App\MesServices\CartServices\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartRemoveController extends AbstractController
{
    /**
     * @Route("/cart/remove/{id}", name="cart_remove", requirements={"id":"\d+"})
     */
    public function remove(CartService $cartService, int $id, 
            ProduitRepository $productRepository, Request $request)
    {
        $produit = $productRepository->find($id);

        if(!$produit)
        {
            $this->addFlash('warning', 'Ce produit n\'existe pas.');
            return $this->redirectToRoute('public_home');
        }

        $cartService->remove($id);

        $this->addFlash('success', 'le produit '. $produit->getNom() .' a bien été supprimé du panier.');

        return $this->redirectToRoute('cart_show');

    }
}