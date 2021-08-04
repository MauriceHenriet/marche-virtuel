<?php

namespace App\Controller\Publique\Panier;

use App\MesServices\CartServices\CartService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NavbarCartController extends AbstractController
{
    /**
     * @Route("/cart/navbar", name="cart_navbar")
     */
    public function nbArticlesAction(CartService $cartService)
    {
        $nbArticles = $cartService->countArticles();

        return $this->render('public/shared/_navbar.html.twig', [
            'nbArticles' => $nbArticles
        ]);
    }
}