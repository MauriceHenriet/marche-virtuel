<?php

namespace App\Controller\Publique\Panier;

use App\MesServices\CartServices\CartService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartShowController extends AbstractController
{
    /**
     * @Route("/cart/show", name="cart_show")
     */
    public function show(CartService $cartService)
    {
        $panier = $cartService->show();

        $fdp = $cartService->getFdp();

        $total = $cartService->getTotal();

        return $this->render('public/cart/panier.html.twig', [
            'panier' => $panier,
            'fdp' => $fdp,
            'total' => $total
            
        ]);
    }
}